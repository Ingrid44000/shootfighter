<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403194602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actualites (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, texte LONGTEXT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, sujet VARCHAR(180) NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participants (id INT AUTO_INCREMENT NOT NULL, recompenses_id INT DEFAULT NULL, tournois_id INT DEFAULT NULL, user_id INT DEFAULT NULL, pseudo VARCHAR(180) NOT NULL, nom VARCHAR(180) NOT NULL, prenom VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, adresse_postale VARCHAR(255) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(180) NOT NULL, pays VARCHAR(180) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_71697092FE50FA14 (recompenses_id), INDEX IDX_71697092752534C (tournois_id), INDEX IDX_71697092A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recompenses (id INT AUTO_INCREMENT NOT NULL, tournois_id INT DEFAULT NULL, nom VARCHAR(180) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, description VARCHAR(180) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_7A7BAB18752534C (tournois_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournois (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, date DATETIME NOT NULL, nb_places_max INT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, date_limite_inscription DATETIME DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, nom VARCHAR(180) DEFAULT NULL, prenom VARCHAR(180) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D64935C246D5 (password), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_71697092FE50FA14 FOREIGN KEY (recompenses_id) REFERENCES recompenses (id)');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_71697092752534C FOREIGN KEY (tournois_id) REFERENCES tournois (id)');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_71697092A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE recompenses ADD CONSTRAINT FK_7A7BAB18752534C FOREIGN KEY (tournois_id) REFERENCES tournois (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_71697092FE50FA14');
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_71697092752534C');
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_71697092A76ED395');
        $this->addSql('ALTER TABLE recompenses DROP FOREIGN KEY FK_7A7BAB18752534C');
        $this->addSql('DROP TABLE actualites');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE participants');
        $this->addSql('DROP TABLE recompenses');
        $this->addSql('DROP TABLE tournois');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
