<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180615094813 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE categorie (id INTEGER NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_497DD634A4D60759 ON categorie (libelle)');
        $this->addSql('CREATE TABLE note (id INTEGER NOT NULL, user_id INTEGER NOT NULL, blague_id INTEGER NOT NULL, note DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CFBDFA14A76ED395 ON note (user_id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA148F220467 ON note (blague_id)');
        $this->addSql('CREATE TABLE user (id INTEGER NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(254) NOT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE blague (id INTEGER NOT NULL, user_id INTEGER NOT NULL, titre VARCHAR(255) NOT NULL, contenu CLOB NOT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9AEC01989C2003F ON blague (contenu)');
        $this->addSql('CREATE INDEX IDX_9AEC019A76ED395 ON blague (user_id)');
        $this->addSql('CREATE TABLE blague_categorie (blague_id INTEGER NOT NULL, categorie_id INTEGER NOT NULL, PRIMARY KEY(blague_id, categorie_id))');
        $this->addSql('CREATE INDEX IDX_4DC26E2E8F220467 ON blague_categorie (blague_id)');
        $this->addSql('CREATE INDEX IDX_4DC26E2EBCF5E72D ON blague_categorie (categorie_id)');
        $this->addSql('CREATE TABLE commentaire (id INTEGER NOT NULL, user_id INTEGER NOT NULL, blague_id INTEGER NOT NULL, contenu CLOB NOT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_67F068BCA76ED395 ON commentaire (user_id)');
        $this->addSql('CREATE INDEX IDX_67F068BC8F220467 ON commentaire (blague_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE blague');
        $this->addSql('DROP TABLE blague_categorie');
        $this->addSql('DROP TABLE commentaire');
    }
}
