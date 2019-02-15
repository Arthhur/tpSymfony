<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190215130101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E748BF5C2E6');
        $this->addSql('DROP INDEX IDX_C82E748BF5C2E6 ON clients');
        $this->addSql('ALTER TABLE clients DROP commandes_id');
        $this->addSql('ALTER TABLE commandes ADD id_client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C99DED506 FOREIGN KEY (id_client_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_35D4282C99DED506 ON commandes (id_client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clients ADD commandes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E748BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_C82E748BF5C2E6 ON clients (commandes_id)');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C99DED506');
        $this->addSql('DROP INDEX IDX_35D4282C99DED506 ON commandes');
        $this->addSql('ALTER TABLE commandes DROP id_client_id');
    }
}
