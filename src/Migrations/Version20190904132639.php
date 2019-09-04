<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190904132639 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exchange ADD cheese_given_id INT NOT NULL');
        $this->addSql('ALTER TABLE exchange ADD CONSTRAINT FK_D33BB0796F8C9031 FOREIGN KEY (cheese_given_id) REFERENCES cheese (id)');
        $this->addSql('CREATE INDEX IDX_D33BB0796F8C9031 ON exchange (cheese_given_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exchange DROP FOREIGN KEY FK_D33BB0796F8C9031');
        $this->addSql('DROP INDEX IDX_D33BB0796F8C9031 ON exchange');
        $this->addSql('ALTER TABLE exchange DROP cheese_given_id');
    }
}
