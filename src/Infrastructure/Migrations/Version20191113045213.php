<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20191113045213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create database schema';
    }

    /**
     * @throws DBALException
     */
    public function up(Schema $schema): void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('CREATE TABLE recipe (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL COMMENT \'(DC2Type:recipe_name)\', portion INT NOT NULL COMMENT \'(DC2Type:portion)\', duration INT NOT NULL COMMENT \'(DC2Type:duration)\', complexity INT NOT NULL COMMENT \'(DC2Type:complexity)\', draft TINYINT(1) DEFAULT \'1\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_step (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', recipe_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', position INT NOT NULL, instruction VARCHAR(255) NOT NULL, INDEX IDX_3CA2A4E359D8A214 (recipe_id), UNIQUE INDEX RECIPE_STEP_POSITION_UNIQUE (recipe_id, position), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe_step ADD CONSTRAINT FK_3CA2A4E359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE TABLE ingredient (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL COMMENT \'(DC2Type:ingredient_name)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_quantity (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', ingredient_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', step_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', quantity VARCHAR(255) NOT NULL COMMENT \'(DC2Type:quantity)\', INDEX IDX_EDF546B8933FE08C (ingredient_id), INDEX IDX_EDF546B873B21E9C (step_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient_quantity ADD CONSTRAINT FK_EDF546B8933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE ingredient_quantity ADD CONSTRAINT FK_EDF546B873B21E9C FOREIGN KEY (step_id) REFERENCES recipe_step (id)');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(255) NOT NULL COMMENT \'(DC2Type:email)\', password VARCHAR(255) NOT NULL COMMENT \'(DC2Type:password)\', created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', day_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', position INT NOT NULL, recipe_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', portion INT DEFAULT NULL COMMENT \'(DC2Type:portion)\', INDEX IDX_9EF68E9C9C24126 (day_id), INDEX IDX_9EF68E9C59D8A214 (recipe_id), UNIQUE INDEX MEAL_DAY_POSITION_UNIQUE (day_id, position), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendar (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_6EA9A146A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE day (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', calendar_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', position INT NOT NULL, INDEX IDX_E5A02990A40A2C8 (calendar_id), UNIQUE INDEX DAY_CALENDAR_POSITION_UNIQUE (calendar_id, position), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C9C24126 FOREIGN KEY (day_id) REFERENCES day (id)');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A146A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE day ADD CONSTRAINT FK_E5A02990A40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    /**
     * @throws DBALException
     */
    public function down(Schema $schema): void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE day DROP FOREIGN KEY FK_E5A02990A40A2C8');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9C9C24126');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE day');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE ingredient_quantity');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('ALTER TABLE recipe_step DROP FOREIGN KEY FK_3CA2A4E359D8A214');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE recipe_step');
    }
}
