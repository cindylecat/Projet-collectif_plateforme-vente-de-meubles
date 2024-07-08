<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240702141547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meuble_eco ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meuble_eco ADD CONSTRAINT FK_49B584EB727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_49B584EB727ACA70 ON meuble_eco (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meuble_eco DROP FOREIGN KEY FK_49B584EB727ACA70');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP INDEX IDX_49B584EB727ACA70 ON meuble_eco');
        $this->addSql('ALTER TABLE meuble_eco DROP parent_id');
    }
}
