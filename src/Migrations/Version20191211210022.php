<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191211210022 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jouer ADD a_gagner TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE persona ADD id_jouer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE persona ADD CONSTRAINT FK_51E5B69B5B27A3F9 FOREIGN KEY (id_jouer_id) REFERENCES jouer (id)');
        $this->addSql('CREATE INDEX IDX_51E5B69B5B27A3F9 ON persona (id_jouer_id)');
        $this->addSql('ALTER TABLE thematique ADD id_jouer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE thematique ADD CONSTRAINT FK_3A8ED5A85B27A3F9 FOREIGN KEY (id_jouer_id) REFERENCES jouer (id)');
        $this->addSql('CREATE INDEX IDX_3A8ED5A85B27A3F9 ON thematique (id_jouer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jouer DROP a_gagner');
        $this->addSql('ALTER TABLE persona DROP FOREIGN KEY FK_51E5B69B5B27A3F9');
        $this->addSql('DROP INDEX IDX_51E5B69B5B27A3F9 ON persona');
        $this->addSql('ALTER TABLE persona DROP id_jouer_id');
        $this->addSql('ALTER TABLE thematique DROP FOREIGN KEY FK_3A8ED5A85B27A3F9');
        $this->addSql('DROP INDEX IDX_3A8ED5A85B27A3F9 ON thematique');
        $this->addSql('ALTER TABLE thematique DROP id_jouer_id');
    }
}
