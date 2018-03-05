<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180305160037 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE test_validation DROP FOREIGN KEY FK_test_validation_id');
        $this->addSql('ALTER TABLE cas_test DROP FOREIGN KEY FK_cas_test_id_test_spe');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_score_id_test_spe');
        $this->addSql('ALTER TABLE reponses DROP FOREIGN KEY FK_reponses_right_choice');
        $this->addSql('DROP TABLE cas_test');
        $this->addSql('DROP TABLE reponses');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE test_spe');
        $this->addSql('DROP TABLE test_validation');
        $this->addSql('ALTER TABLE test_video ADD id_souscategorie INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test_video ADD CONSTRAINT FK_77197C27D1DB7664 FOREIGN KEY (id_souscategorie) REFERENCES sous_categorie (id)');
        $this->addSql('CREATE INDEX IDX_77197C27D1DB7664 ON test_video (id_souscategorie)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cas_test (id INT NOT NULL, id_cas_clinique INT NOT NULL, id_test_spe INT NOT NULL, id_sous_categorie INT NOT NULL, INDEX FK_cas_test_id_cas_clinique (id_cas_clinique), INDEX FK_cas_test_id_test_spe (id_test_spe), INDEX FK_cas_test_id_sous_categorie (id_sous_categorie), INDEX IDX_D849B905BF396750 (id), PRIMARY KEY(id, id_cas_clinique, id_test_spe, id_sous_categorie)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponses (id INT AUTO_INCREMENT NOT NULL, id_questions INT DEFAULT NULL, right_choice INT DEFAULT NULL, reponse TEXT DEFAULT NULL COLLATE utf8_bin, INDEX FK_reponses_id_questions (id_questions), INDEX FK_reponses_right_choice (right_choice), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score (id INT NOT NULL, id_test_video INT NOT NULL, id_cas_clinique INT NOT NULL, id_test_spe INT NOT NULL, score DOUBLE PRECISION DEFAULT NULL, INDEX FK_score_id_test_video (id_test_video), INDEX FK_score_id_cas_clinique (id_cas_clinique), INDEX FK_score_id_test_spe (id_test_spe), INDEX IDX_32993751BF396750 (id), PRIMARY KEY(id, id_test_video, id_cas_clinique, id_test_spe)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_spe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) DEFAULT NULL COLLATE utf8_bin, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_validation (right_choice INT AUTO_INCREMENT NOT NULL, id INT DEFAULT NULL, good_com TEXT DEFAULT NULL COLLATE utf8_bin, bad_com TEXT DEFAULT NULL COLLATE utf8_bin, prev INT DEFAULT NULL, INDEX FK_test_validation_id (id), PRIMARY KEY(right_choice)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cas_test ADD CONSTRAINT FK_cas_test_id FOREIGN KEY (id) REFERENCES test_video (id)');
        $this->addSql('ALTER TABLE cas_test ADD CONSTRAINT FK_cas_test_id_cas_clinique FOREIGN KEY (id_cas_clinique) REFERENCES cas_clinique (id)');
        $this->addSql('ALTER TABLE cas_test ADD CONSTRAINT FK_cas_test_id_sous_categorie FOREIGN KEY (id_sous_categorie) REFERENCES sous_categorie (id)');
        $this->addSql('ALTER TABLE cas_test ADD CONSTRAINT FK_cas_test_id_test_spe FOREIGN KEY (id_test_spe) REFERENCES test_spe (id)');
        $this->addSql('ALTER TABLE reponses ADD CONSTRAINT FK_reponses_id_questions FOREIGN KEY (id_questions) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE reponses ADD CONSTRAINT FK_reponses_right_choice FOREIGN KEY (right_choice) REFERENCES test_validation (right_choice)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_score_id FOREIGN KEY (id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_score_id_cas_clinique FOREIGN KEY (id_cas_clinique) REFERENCES cas_clinique (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_score_id_test_spe FOREIGN KEY (id_test_spe) REFERENCES test_spe (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_score_id_test_video FOREIGN KEY (id_test_video) REFERENCES test_video (id)');
        $this->addSql('ALTER TABLE test_validation ADD CONSTRAINT FK_test_validation_id FOREIGN KEY (id) REFERENCES reponses (id)');
        $this->addSql('ALTER TABLE test_video DROP FOREIGN KEY FK_77197C27D1DB7664');
        $this->addSql('DROP INDEX IDX_77197C27D1DB7664 ON test_video');
        $this->addSql('ALTER TABLE test_video DROP id_souscategorie');
    }
}
