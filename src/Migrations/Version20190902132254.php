<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902132254 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exchange ADD ad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exchange ADD CONSTRAINT FK_D33BB0794F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D33BB0794F34D596 ON exchange (ad_id)');
        $this->addSql('ALTER TABLE ad ADD cheese_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED582AD46E66 FOREIGN KEY (cheese_id) REFERENCES cheese (id)');
        $this->addSql('CREATE INDEX IDX_77E0ED582AD46E66 ON ad (cheese_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED582AD46E66');
        $this->addSql('DROP INDEX IDX_77E0ED582AD46E66 ON ad');
        $this->addSql('ALTER TABLE ad DROP cheese_id');
        $this->addSql('ALTER TABLE exchange DROP FOREIGN KEY FK_D33BB0794F34D596');
        $this->addSql('DROP INDEX UNIQ_D33BB0794F34D596 ON exchange');
        $this->addSql('ALTER TABLE exchange DROP ad_id');
    }
}
