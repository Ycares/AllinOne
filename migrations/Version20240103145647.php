<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240103145647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competences_user (competences_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_2AFA32F9A660B158 (competences_id), INDEX IDX_2AFA32F9A76ED395 (user_id), PRIMARY KEY(competences_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competences_user ADD CONSTRAINT FK_2AFA32F9A660B158 FOREIGN KEY (competences_id) REFERENCES competences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competences_user ADD CONSTRAINT FK_2AFA32F9A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competences_user DROP FOREIGN KEY FK_2AFA32F9A660B158');
        $this->addSql('ALTER TABLE competences_user DROP FOREIGN KEY FK_2AFA32F9A76ED395');
        $this->addSql('DROP TABLE competences_user');
    }
}
