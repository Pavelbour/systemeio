<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240326153825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE payment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE promo_code_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tax_number_validator_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE payment (id INT NOT NULL, order_id INT NOT NULL, amount INT NOT NULL, payment_system_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE promo_code (id INT NOT NULL, type INT NOT NULL, code VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tax_number_validator (id INT NOT NULL, code VARCHAR(2) NOT NULL, regex VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE payment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE promo_code_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tax_number_validator_id_seq CASCADE');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE promo_code');
        $this->addSql('DROP TABLE tax_number_validator');
    }
}
