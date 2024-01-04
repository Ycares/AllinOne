<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240103152716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, ADD salaire NUMERIC(10, 0) NOT NULL, ADD metier VARCHAR(255) NOT NULL, CHANGE photo_profil photo_profil VARCHAR(1000) DEFAULT NULL, CHANGE cv cv VARCHAR(500) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP roles, DROP salaire, DROP metier, CHANGE photo_profil photo_profil VARCHAR(1000) NOT NULL, CHANGE cv cv VARCHAR(500) NOT NULL');
    }
}