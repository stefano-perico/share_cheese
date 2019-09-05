<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190905095010 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exchange ADD applicant_id INT NOT NULL');
        $this->addSql('ALTER TABLE exchange ADD CONSTRAINT FK_D33BB07997139001 FOREIGN KEY (applicant_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D33BB07997139001 ON exchange (applicant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article ADD image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE exchange DROP FOREIGN KEY FK_D33BB07997139001');
        $this->addSql('DROP INDEX IDX_D33BB07997139001 ON exchange');
        $this->addSql('ALTER TABLE exchange DROP applicant_id');
    }
}
