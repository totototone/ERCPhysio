<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180302101753 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_questions_id_test');
        $this->addSql('CREATE TABLE cas_test (id INT AUTO_INCREMENT NOT NULL, id_cas_clinique INT DEFAULT NULL, id_sous_categorie INT DEFAULT NULL, id_test_spe INT DEFAULT NULL, UNIQUE INDEX UNIQ_D849B905411140DC (id_cas_clinique), UNIQUE INDEX UNIQ_D849B9056F12807D (id_sous_categorie), UNIQUE INDEX UNIQ_D849B90592B7D368 (id_test_spe), INDEX FK_cas_test_id_cas_clinique (id_cas_clinique), INDEX FK_cas_test_id_test_spe (id_test_spe), INDEX FK_cas_test_id_sous_categorie (id_sous_categorie), INDEX IDX_D849B905BF396750 (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, id_cas_clinique INT DEFAULT NULL, id_test_spe INT DEFAULT NULL, id_test_video INT DEFAULT NULL, score DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_32993751411140DC (id_cas_clinique), UNIQUE INDEX UNIQ_3299375192B7D368 (id_test_spe), UNIQUE INDEX UNIQ_32993751D293FCF0 (id_test_video), INDEX FK_score_id_test_video (id_test_video), INDEX FK_score_id_cas_clinique (id_cas_clinique), INDEX FK_score_id_test_spe (id_test_spe), INDEX IDX_32993751BF396750 (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie (id INT AUTO_INCREMENT NOT NULL, id_categorie INT DEFAULT NULL, name VARCHAR(25) DEFAULT NULL, INDEX FK_sous_categorie_id_categorie (id_categorie), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_validation (right_choice INT AUTO_INCREMENT NOT NULL, id INT DEFAULT NULL, good_com TEXT DEFAULT NULL, bad_com TEXT DEFAULT NULL, prev INT DEFAULT NULL, INDEX FK_test_validation_id (id), PRIMARY KEY(right_choice)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_video (id INT AUTO_INCREMENT NOT NULL, scenarios_name VARCHAR(50) DEFAULT NULL, video VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cas_test ADD CONSTRAINT FK_D849B905BF396750 FOREIGN KEY (id) REFERENCES test_video (id)');
        $this->addSql('ALTER TABLE cas_test ADD CONSTRAINT FK_D849B905411140DC FOREIGN KEY (id_cas_clinique) REFERENCES cas_clinique (id)');
        $this->addSql('ALTER TABLE cas_test ADD CONSTRAINT FK_D849B9056F12807D FOREIGN KEY (id_sous_categorie) REFERENCES sous_categorie (id)');
        $this->addSql('ALTER TABLE cas_test ADD CONSTRAINT FK_D849B90592B7D368 FOREIGN KEY (id_test_spe) REFERENCES test_spe (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751BF396750 FOREIGN KEY (id) REFERENCES app_users (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751411140DC FOREIGN KEY (id_cas_clinique) REFERENCES cas_clinique (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_3299375192B7D368 FOREIGN KEY (id_test_spe) REFERENCES test_spe (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751D293FCF0 FOREIGN KEY (id_test_video) REFERENCES test_video (id)');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BC9486A13 FOREIGN KEY (id_categorie) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE test_validation ADD CONSTRAINT FK_6D9FED57BF396750 FOREIGN KEY (id) REFERENCES reponses (id)');
        $this->addSql('DROP TABLE hypotheses');
        $this->addSql('DROP TABLE test');
        $this->addSql('ALTER TABLE cas_clinique DROP FOREIGN KEY FK_cas_clinique_id_categorie');
        $this->addSql('DROP INDEX FK_cas_clinique_id_categorie ON cas_clinique');
        $this->addSql('ALTER TABLE cas_clinique DROP id_categorie');
        $this->addSql('ALTER TABLE categorie DROP rel_prev, DROP rel_next, CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX FK_questions_id_test ON questions');
        $this->addSql('ALTER TABLE questions ADD stop INT DEFAULT NULL, ADD reponse TEXT DEFAULT NULL, CHANGE id_test id_test_video INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5D293FCF0 FOREIGN KEY (id_test_video) REFERENCES test_video (id)');
        $this->addSql('CREATE INDEX FK_questions_id_test_video ON questions (id_test_video)');
        $this->addSql('ALTER TABLE reponses ADD right_choice INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponses ADD CONSTRAINT FK_1E512EC6C153B009 FOREIGN KEY (right_choice) REFERENCES test_validation (right_choice)');
        $this->addSql('CREATE INDEX FK_reponses_right_choice ON reponses (right_choice)');
        $this->addSql('ALTER TABLE test_spe DROP FOREIGN KEY FK_test_spe_id_categorie');
        $this->addSql('DROP INDEX FK_test_spe_id_categorie ON test_spe');
        $this->addSql('ALTER TABLE test_spe DROP id_categorie');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cas_test DROP FOREIGN KEY FK_D849B9056F12807D');
        $this->addSql('ALTER TABLE reponses DROP FOREIGN KEY FK_1E512EC6C153B009');
        $this->addSql('ALTER TABLE cas_test DROP FOREIGN KEY FK_D849B905BF396750');
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D5D293FCF0');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751D293FCF0');
        $this->addSql('CREATE TABLE hypotheses (id INT AUTO_INCREMENT NOT NULL, id_cas_clinique INT DEFAULT NULL, hypothese TEXT DEFAULT NULL COLLATE utf8_bin, INDEX FK_hypotheses_id_cas_clinique (id_cas_clinique), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, id_categorie INT DEFAULT NULL, name VARCHAR(25) DEFAULT NULL COLLATE utf8_bin, INDEX IDX_D87F7E0CC9486A13 (id_categorie), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hypotheses ADD CONSTRAINT FK_hypotheses_id_cas_clinique FOREIGN KEY (id_cas_clinique) REFERENCES cas_clinique (id)');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_test_id_categorie FOREIGN KEY (id_categorie) REFERENCES categorie (id)');
        $this->addSql('DROP TABLE cas_test');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE sous_categorie');
        $this->addSql('DROP TABLE test_validation');
        $this->addSql('DROP TABLE test_video');
        $this->addSql('ALTER TABLE cas_clinique ADD id_categorie INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cas_clinique ADD CONSTRAINT FK_cas_clinique_id_categorie FOREIGN KEY (id_categorie) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX FK_cas_clinique_id_categorie ON cas_clinique (id_categorie)');
        $this->addSql('ALTER TABLE categorie ADD rel_prev INT DEFAULT NULL, ADD rel_next INT DEFAULT NULL, CHANGE name name VARCHAR(25) DEFAULT NULL COLLATE utf8_bin');
        $this->addSql('DROP INDEX FK_questions_id_test_video ON questions');
        $this->addSql('ALTER TABLE questions ADD id_test INT DEFAULT NULL, DROP id_test_video, DROP stop, DROP reponse');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_questions_id_test FOREIGN KEY (id_test) REFERENCES test (id)');
        $this->addSql('CREATE INDEX FK_questions_id_test ON questions (id_test)');
        $this->addSql('DROP INDEX FK_reponses_right_choice ON reponses');
        $this->addSql('ALTER TABLE reponses DROP right_choice');
        $this->addSql('ALTER TABLE test_spe ADD id_categorie INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test_spe ADD CONSTRAINT FK_test_spe_id_categorie FOREIGN KEY (id_categorie) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX FK_test_spe_id_categorie ON test_spe (id_categorie)');
    }
}
