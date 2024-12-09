<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209102112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE emails');
        $this->addSql('DROP TABLE tickets');
        $this->addSql('ALTER TABLE invoice_items CHANGE invoice_id invoice_id INT NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE quantity quantity INT NOT NULL, CHANGE unit_price unit_price NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE invoice_items RENAME INDEX invoice_id TO IDX_DCC4B9F82989F1FD');
        $this->addSql('ALTER TABLE invoices CHANGE invoice_number invoice_number VARCHAR(255) NOT NULL, CHANGE status status INT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emails (id INT AUTO_INCREMENT NOT NULL, subject TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, status SMALLINT UNSIGNED NOT NULL, text_body LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, html_body LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, meta JSON DEFAULT NULL, created_at DATETIME DEFAULT NULL, sent_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tickets (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, content TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, user_id INT NOT NULL, template_id INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE invoices CHANGE invoice_number invoice_number VARCHAR(50) NOT NULL, CHANGE status status SMALLINT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice_items CHANGE invoice_id invoice_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL, CHANGE unit_price unit_price NUMERIC(10, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE invoice_items RENAME INDEX idx_dcc4b9f82989f1fd TO invoice_id');
    }
}
