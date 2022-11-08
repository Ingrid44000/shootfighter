<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221107190126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actualites (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, texte LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participants (id INT AUTO_INCREMENT NOT NULL, recompense_id INT DEFAULT NULL, pseudo VARCHAR(180) NOT NULL, nom VARCHAR(180) NOT NULL, prenom VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, adresse_postale VARCHAR(255) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(180) NOT NULL, pays VARCHAR(180) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_716970924D714096 (recompense_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participants_tournois (participants_id INT NOT NULL, tournois_id INT NOT NULL, INDEX IDX_B5D9C68D838709D5 (participants_id), INDEX IDX_B5D9C68D752534C (tournois_id), PRIMARY KEY(participants_id, tournois_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recompenses (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, image_name VARCHAR(255) NOT NULL, description VARCHAR(180) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recompenses_tournois (recompenses_id INT NOT NULL, tournois_id INT NOT NULL, INDEX IDX_87535B32FE50FA14 (recompenses_id), INDEX IDX_87535B32752534C (tournois_id), PRIMARY KEY(recompenses_id, tournois_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournois (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, date DATETIME NOT NULL, nb_places_max INT NOT NULL, image_name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, date_limite_inscription DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_716970924D714096 FOREIGN KEY (recompense_id) REFERENCES recompenses (id)');
        $this->addSql('ALTER TABLE participants_tournois ADD CONSTRAINT FK_B5D9C68D838709D5 FOREIGN KEY (participants_id) REFERENCES participants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participants_tournois ADD CONSTRAINT FK_B5D9C68D752534C FOREIGN KEY (tournois_id) REFERENCES tournois (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recompenses_tournois ADD CONSTRAINT FK_87535B32FE50FA14 FOREIGN KEY (recompenses_id) REFERENCES recompenses (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recompenses_tournois ADD CONSTRAINT FK_87535B32752534C FOREIGN KEY (tournois_id) REFERENCES tournois (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_716970924D714096');
        $this->addSql('ALTER TABLE participants_tournois DROP FOREIGN KEY FK_B5D9C68D838709D5');
        $this->addSql('ALTER TABLE participants_tournois DROP FOREIGN KEY FK_B5D9C68D752534C');
        $this->addSql('ALTER TABLE recompenses_tournois DROP FOREIGN KEY FK_87535B32FE50FA14');
        $this->addSql('ALTER TABLE recompenses_tournois DROP FOREIGN KEY FK_87535B32752534C');
        $this->addSql('DROP TABLE actualites');
        $this->addSql('DROP TABLE participants');
        $this->addSql('DROP TABLE participants_tournois');
        $this->addSql('DROP TABLE recompenses');
        $this->addSql('DROP TABLE recompenses_tournois');
        $this->addSql('DROP TABLE tournois');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
