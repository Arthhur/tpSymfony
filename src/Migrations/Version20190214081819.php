<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190214081819 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E7482EA2E54');
        $this->addSql('DROP INDEX IDX_C82E7482EA2E54 ON clients');
        $this->addSql('ALTER TABLE clients DROP commande_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clients ADD commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E7482EA2E54 FOREIGN KEY (commande_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_C82E7482EA2E54 ON clients (commande_id)');
    }
}
