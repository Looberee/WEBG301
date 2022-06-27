<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627231054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE transaction_reports (id INT AUTO_INCREMENT NOT NULL, order_id_id INT DEFAULT NULL, customer_id_id INT DEFAULT NULL, food_id_id INT DEFAULT NULL, supply_id_id INT DEFAULT NULL, delivery_id_id INT DEFAULT NULL, date_supply DATE NOT NULL, INDEX IDX_87B59BA7FCDAEAAA (order_id_id), INDEX IDX_87B59BA7B171EB6C (customer_id_id), INDEX IDX_87B59BA78E255BBD (food_id_id), INDEX IDX_87B59BA71B94DEF3 (supply_id_id), INDEX IDX_87B59BA76F4F78C5 (delivery_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction_reports ADD CONSTRAINT FK_87B59BA7FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE transaction_reports ADD CONSTRAINT FK_87B59BA7B171EB6C FOREIGN KEY (customer_id_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE transaction_reports ADD CONSTRAINT FK_87B59BA78E255BBD FOREIGN KEY (food_id_id) REFERENCES food (id)');
        $this->addSql('ALTER TABLE transaction_reports ADD CONSTRAINT FK_87B59BA71B94DEF3 FOREIGN KEY (supply_id_id) REFERENCES food_supply (id)');
        $this->addSql('ALTER TABLE transaction_reports ADD CONSTRAINT FK_87B59BA76F4F78C5 FOREIGN KEY (delivery_id_id) REFERENCES delivery (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE transaction_reports');
    }
}
