<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230617142202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création de la table Planning pour les horaires';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE planning (id INT AUTO_INCREMENT NOT NULL, day_of_the_week VARCHAR(255) NOT NULL, morning_start TIME DEFAULT NULL, morning_end TIME DEFAULT NULL, afternoon_start TIME DEFAULT NULL, afternoon_end TIME DEFAULT NULL, UNIQUE INDEX UNIQ_D499BFF6C7D48B80 (day_of_the_week), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE planning');
    }
}
