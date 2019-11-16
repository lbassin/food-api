<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191116204850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('CREATE TABLE ingredient_quantity (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', ingredient_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', step_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', quantity INT NOT NULL, INDEX IDX_EDF546B8933FE08C (ingredient_id), INDEX IDX_EDF546B873B21E9C (step_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient_quantity ADD CONSTRAINT FK_EDF546B8933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE ingredient_quantity ADD CONSTRAINT FK_EDF546B873B21E9C FOREIGN KEY (step_id) REFERENCES recipe_step (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ingredient_quantity');
    }
}
