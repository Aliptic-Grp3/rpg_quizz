<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191211193219 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE niveau ADD libelle VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE questions ADD id_thematique_id INT NOT NULL, ADD id_niveau_id INT NOT NULL, ADD libelle VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5F94D87CA FOREIGN KEY (id_thematique_id) REFERENCES thematique (id)');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D58B0B20A6 FOREIGN KEY (id_niveau_id) REFERENCES niveau (id)');
        $this->addSql('CREATE INDEX IDX_8ADC54D5F94D87CA ON questions (id_thematique_id)');
        $this->addSql('CREATE INDEX IDX_8ADC54D58B0B20A6 ON questions (id_niveau_id)');
        $this->addSql('ALTER TABLE reponse ADD id_question_id INT NOT NULL, ADD libelle VARCHAR(255) NOT NULL, ADD est_correct TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC76353B48 FOREIGN KEY (id_question_id) REFERENCES questions (id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC76353B48 ON reponse (id_question_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE niveau DROP libelle');
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D5F94D87CA');
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D58B0B20A6');
        $this->addSql('DROP INDEX IDX_8ADC54D5F94D87CA ON questions');
        $this->addSql('DROP INDEX IDX_8ADC54D58B0B20A6 ON questions');
        $this->addSql('ALTER TABLE questions DROP id_thematique_id, DROP id_niveau_id, DROP libelle');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC76353B48');
        $this->addSql('DROP INDEX IDX_5FB6DEC76353B48 ON reponse');
        $this->addSql('ALTER TABLE reponse DROP id_question_id, DROP libelle, DROP est_correct');
    }
}
