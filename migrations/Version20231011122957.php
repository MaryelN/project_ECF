<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231011122957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, fuel_id INT NOT NULL, transmission_id INT NOT NULL, name VARCHAR(150) NOT NULL, year INT NOT NULL, km INT NOT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_773DE69D97C79677 (fuel_id), INDEX IDX_773DE69D78D28519 (transmission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, rating_id INT NOT NULL, name VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, INDEX IDX_9474526CA32EFC6 (rating_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_form (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', message VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fuel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hours (id INT AUTO_INCREMENT NOT NULL, day_name VARCHAR(50) NOT NULL, hour_am_1 TIME NOT NULL, hour_am_2 TIME NOT NULL, hour_pm_1 TIME NOT NULL, hour_pm_2 TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, rating SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, price NUMERIC(10, 2) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transmission (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(50) NOT NULL, name VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, address VARCHAR(150) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', phone VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D97C79677 FOREIGN KEY (fuel_id) REFERENCES fuel (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D78D28519 FOREIGN KEY (transmission_id) REFERENCES transmission (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D97C79677');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D78D28519');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA32EFC6');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE contact_form');
        $this->addSql('DROP TABLE fuel');
        $this->addSql('DROP TABLE hours');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE transmission');
        $this->addSql('DROP TABLE user');
    }
}
