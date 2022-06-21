<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220621110846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD food_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993988E255BBD FOREIGN KEY (food_id_id) REFERENCES food (id)');
        $this->addSql('CREATE INDEX IDX_F52993988E255BBD ON `order` (food_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993988E255BBD');
        $this->addSql('DROP INDEX IDX_F52993988E255BBD ON `order`');
        $this->addSql('ALTER TABLE `order` DROP food_id_id');
    }
}
