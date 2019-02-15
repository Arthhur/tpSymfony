<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190215090142 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE passer (id INT NOT NULL, id_client INT NOT NULL, INDEX IDX_970EA416BF396750 (id), INDEX IDX_970EA416E173B1B8 (id_client), PRIMARY KEY(id, id_client)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE passer ADD CONSTRAINT FK_970EA416BF396750 FOREIGN KEY (id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE passer ADD CONSTRAINT FK_970EA416E173B1B8 FOREIGN KEY (id_client) REFERENCES catalogues (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE passer');
    }
}
