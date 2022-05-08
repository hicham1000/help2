<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220302195900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE appuser_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE context_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE post_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE univers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE appuser ALTER username TYPE VARCHAR(180)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EE8A7C74F85E0677 ON appuser (username)');
        $this->addSql('ALTER TABLE context ADD CONSTRAINT FK_E25D857E1CF61C0B FOREIGN KEY (univers_id) REFERENCES univers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E25D857E1CF61C0B ON context (univers_id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D6B00C1CF FOREIGN KEY (context_id) REFERENCES context (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D6B00C1CF ON post (context_id)');
        $this->addSql('ALTER TABLE post ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE appuser_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE context_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE post_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE univers_id_seq CASCADE');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, lastname VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP INDEX UNIQ_EE8A7C74F85E0677');
        $this->addSql('ALTER TABLE appuser ALTER username TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE context DROP CONSTRAINT FK_E25D857E1CF61C0B');
        $this->addSql('DROP INDEX IDX_E25D857E1CF61C0B');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8D6B00C1CF');
        $this->addSql('DROP INDEX IDX_5A8A6C8D6B00C1CF');
        $this->addSql('DROP INDEX "primary"');
    }
}
