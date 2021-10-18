<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210823091319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE context ADD univers_id INT NOT NULL');
        $this->addSql('ALTER TABLE context ADD CONSTRAINT FK_E25D857E1CF61C0B FOREIGN KEY (univers_id) REFERENCES univers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E25D857E1CF61C0B ON context (univers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE context DROP CONSTRAINT FK_E25D857E1CF61C0B');
        $this->addSql('DROP INDEX IDX_E25D857E1CF61C0B');
        $this->addSql('ALTER TABLE context DROP univers_id');
    }
}
