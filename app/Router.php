<?php

declare(strict_types=1);

namespace App;

use App\Attributes\Route;
use App\Exceptions\RouteNotFoundException;
use Illuminate\Container\Container;
use  ReflectionAttribute;


class Router
{
    private array $routes = [];

    public function __construct(private Container $container)
    {
    }

    /**
     * @param array $controllers
     * @throws \ReflectionException
     */
    public function registerRoutesFromControllerAttributes(array $controllers): void
    {
        foreach ($controllers as $controller) {
            $reflectionController = new \ReflectionClass($controller);

            foreach ($reflectionController->getMethods() as $method) {
                $attributes = $method->getAttributes(Route::class, ReflectionAttribute::IS_INSTANCEOF);

                foreach ($attributes as $attribute) {
                    $route = $attribute->newInstance();

                    $this->register($route->method->value, $route->path, [$controller, $method->getName()]);
                }
            }
        }
    }

    /**
     * @param  string          $methodRequest
     * @param  string          $route
     * @param  callable|array  $action
     *
     * @return $this
     */
    public function register(
        string $methodRequest,
        string $route,
        callable|array $action
    ): self {
        $this->routes[$methodRequest][$route] = $action;

        return $this;
    }

    /**
     * @param  string          $route
     * @param  callable|array  $action
     *
     * @return $this
     */
    public function get(string $route, callable|array $action): self
    {
        return $this->register('get', $route, $action);
    }

    /**
     * @param  string          $route
     * @param  callable|array  $action
     *
     * @return $this
     */
    public function post(string $route, callable|array $action): self
    {
        return $this->register('post', $route, $action);
    }

    /**
     * @return array
     */
    public function routes(): array
    {
        return $this->routes;
    }

    /**
     * @param  string  $requestUri
     * @param  string  $requestMethod
     *
     * @return mixed
     * @throws RouteNotFoundException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function resolve(string $requestUri, string $requestMethod): mixed
    {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_array($action)) {
            [$class, $method] = $action;

            if (class_exists($class)) {
                $class = $this->container->get($class);

                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }
        throw new RouteNotFoundException();
    }
}