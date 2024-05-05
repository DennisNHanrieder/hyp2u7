<?php

namespace HYP2UE07;

use PDO;
use PDOException;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Creates the database, table and user entries for this example to work.
 * @package HYP2UE07
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @version 2024
 */
class CreateDB
{
    /**
     * @var PDO The PDO object.
     */
    private PDO $dbh;

    /**
     * @var Environment Provides a Twig object to display HTML templates.
     */
    private Environment $twig;

    /**
     * @var array[] An array of available products.
     */
    private array $products;

    /**
     * @var bool Tracks if the schema has been created.
     */
    private bool $schemaCreated;

    /**
     * @var bool Tracks if the table has been created.
     */
    private bool $tableCreated;

    /**
     * @var int Tracks how many products have been created.
     */
    private int $nrOfProductsCreated;

    /**
     * Creates a new object for database initialization. First, an array of products is defined which is later stored in
     * the database. Status variables are then initialized and a database connection is established.
     * @param Environment $twig The Twig object for displaying a response.
     */
    public function __construct(Environment $twig)
    {
        $this->products = [
            [
                "item_nr" => "11234115",
                "product_name" => "Game Controller",
                "product_description" => "Wireless Game Controller für PC",
                "available_quantity" => 234,
                "price" => 39.99
            ],
            [
                "item_nr" => "54325324",
                "product_name" => "Rennlenkrad",
                "product_description" => "Rennlenkrad für PC/Xbox/PS mit Force Feedback",
                "available_quantity" => 127,
                "price" => 329.00
            ],
            [
                "item_nr" => "21335689",
                "product_name" => "4K Monitor",
                "product_description" => "28\" 4K Gaming Monitor UHD IPS",
                "available_quantity" => 1234,
                "price" => 513.28
            ]
        ];

        $this->twig = $twig;

        $this->schemaCreated = false;
        $this->tableCreated = false;
        $this->nrOfProductsCreated = 0;

        $this->initDB();
    }

    /**
     * Initializes the database connection.
     * @return void Returns nothing.
     */
    private function initDB(): void
    {
        $charsetAttr = "SET NAMES utf8 COLLATE utf8_general_ci";
        $dsn = "mysql:host=db;port=3306";
        $mysqlUser = "hypermedia";
        $mysqlPwd = "geheim";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => $charsetAttr,
            PDO::MYSQL_ATTR_MULTI_STATEMENTS => false
        ];
        $this->dbh = new PDO($dsn, $mysqlUser, $mysqlPwd, $options);
    }

    /**
     * Creates the database schema "ue07_products" if it does not exist.
     * @return void Returns nothing.
     */
    public function createSchema(): void
    {
        $rowsAffected = $this->dbh->exec(
            "CREATE SCHEMA IF NOT EXISTS ue07_products DEFAULT CHARACTER SET utf8;"
        );

        if ($rowsAffected > 0) {
            $this->schemaCreated = true;
        }
    }

    /**
     * Creates the table "product". Since a CREATE TABLE statement does not affect rows, the only way to check if the
     * table was already present is to trigger an exception.
     * @return void Returns nothing.
     */
    public function createTable(): void
    {
        $query = "CREATE TABLE ue07_products.product (id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                                          item_nr VARCHAR(8) NOT NULL,
                                                          product_name VARCHAR(100) NOT NULL,
                                                          product_description VARCHAR(255) NOT NULL,
                                                          available_quantity DECIMAL(10,0),
                                                          price DECIMAL(10,2),
                                                          PRIMARY KEY (id)) ENGINE = InnoDB";
        try {
            $this->dbh->exec($query);
            $this->tableCreated = true;
        } catch (PDOException $exception) {
            // If there's an exception the table was already created. Do nothing.
        }
    }

    /**
     * Add example products to the table "product". First, all entries are queried, then before inserting a new product
     * a check is performed if item number is already present in the table. If this is the case, no product is
     * inserted.
     * @return void Returns nothing.
     */
    public function addProducts(): void
    {
        $checkQuery = "SELECT item_nr FROM ue07_products.product";
        $insertQuery = "INSERT INTO ue07_products.product SET item_nr = :item_nr,
                                                              product_name = :product_name,
                                                              product_description = :product_description,
                                                              available_quantity = :available_quantity,
                                                              price = :price";

        $checkStatement = $this->dbh->query($checkQuery);
        $productRows = $checkStatement->fetchAll(PDO::FETCH_COLUMN);

        foreach ($this->products as $product) {
            if (!in_array($product["item_nr"], $productRows)) {
                $statement = $this->dbh->prepare($insertQuery);
                $params = [
                    ":item_nr" => $product["item_nr"],
                    ":product_name" => $product["product_name"],
                    ":product_description" => $product["product_description"],
                    ":available_quantity" => $product["available_quantity"],
                    ":price" => $product["price"]
                ];
                $success = $statement->execute($params);
                if ($success) {
                    $this->nrOfProductsCreated++;
                }
            }
        }
    }

    /**
     * Displays output (a response) by showing a Twig template.
     * @return void Returns nothing
     * @throws LoaderError Displays a LoaderError if the template file cannot be loaded.
     * @throws RuntimeError Displays a RuntimeError if there is an issue at runtime.
     * @throws SyntaxError Displays a SyntaxError if there is an error in the template.
     */
    public function displayOutput(): void
    {
        $this->twig->display("createdb.html.twig", [
            "schemaCreated" => $this->schemaCreated ? "Yes" : "No",
            "tableCreated" => $this->tableCreated ? "Yes" : "No",
            "nrOfUsersCreated" => $this->nrOfProductsCreated
        ]);
    }
}
