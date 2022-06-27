<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627081446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delivery ADD customer_id_id INT DEFAULT NULL, ADD food_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10B171EB6C FOREIGN KEY (customer_id_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC108E255BBD FOREIGN KEY (food_id_id) REFERENCES food (id)');
        $this->addSql('CREATE INDEX IDX_3781EC10B171EB6C ON delivery (customer_id_id)');
        $this->addSql('CREATE INDEX IDX_3781EC108E255BBD ON delivery (food_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10B171EB6C');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC108E255BBD');
        $this->addSql('DROP INDEX IDX_3781EC10B171EB6C ON delivery');
        $this->addSql('DROP INDEX IDX_3781EC108E255BBD ON delivery');
        $this->addSql('ALTER TABLE delivery DROP customer_id_id, DROP food_id_id');
    }
}
