<?php

namespace HYP2UE07;

use PDO;
use Twig\Environment;

/**
 * Takes data from a database and exports it to various formats (XML, JSON, PDF).
 * @package HYP2UE07
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @version 2024
 */
class ProductExporter
{
    /**
     * @var Environment Provides a Twig object to display HTML templates.
     */
    private Environment $twig;

    /**
     * @var PDO The PDO object.
     */
    private PDO $dbh;

    /**
     * @var ExportFormat The currently used export format (either XML, JSON or PDF).
     */
    private ExportFormat $format;

    /**
     * @var string The filename for the currently exported file.
     */
    private string $filename;

    /**
     * Creates a new ProductExporter object. Initializes the Twig object for output and creates a database connection.
     * @param Environment $twig The Twig object for displaying a response.
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
        $this->initDB();
    }

    /**
     * Initializes the database connection.
     * @return void Returns nothing.
     */
    private function initDB(): void
    {
        $charsetAttr = "SET NAMES utf8 COLLATE utf8_general_ci";
        $dsn = "mysql:host=db;port=3306;dbname=ue07_products";
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
     * Exports data from the database into a format defined by the parameter $format and into a file of the given
     * filename. Calls one of the three private export methods, depending on the format.
     * @param ExportFormat $format The desired format.
     * @param string $filename The filename used for export.
     * @return void Returns nothing.
     */
    public function export(ExportFormat $format, string $filename): void
    {
        $this->format = $format;
        $this->filename = $filename;
        // TODO: Make a database query using the PDO object to get the item_nr, product_name, product_description,
        //       available_quantity and price from the product table.
        $query = "SELECT item_nr, product_name, product_description, available_quantity, price FROM product";
        $statement = $this->dbh->prepare($query);
        $statement->execute();

        $products = $statement->fetchAll();
        //var_dump($products);

        match($format){
            ExportFormat::XML => $this->exportXML($products, $filename),
            ExportFormat::JSON => $this->exportJSON($products, $filename),
            ExportFormat::PDF => $this->exportPDF($products, $filename),
        };

        // TODO: Store the result (rows) array. This array contains all the three example products as objects (because
        //       of the PDO::FETCH_OBJ option in the PDO constructor).

        // TODO: Based on the argument in $format, either call exportXML(), exportJSON() or exportPDF().
        //       Pass the array with the products to the methods and the filename.
    }

    /**
     * Exports the products to an XML file.
     * @param array $products The list of products from the database.
     * @param string $filename The XML file name.
     * @return void Returns nothing.
     */
    private function exportXML(array $products, string $filename): void
    {
        // TODO: Use either XMLWriter or DOM to create an XML file from the data in $products and write it into the file
        //       with $filename. The file can will be stored in /public. That's fine.
    }

    /**
     * Exports the products to a JSON file.
     * @param array $products The list of products from the database.
     * @param string $filename The JSON file name.
     * @return void Returns nothing.
     */
    private function exportJSON(array $products, string $filename): void
    {
        // TODO: Use json_encode() to create a JSON data structure from $products and write it into the file
        //       with $filename. The file can will be stored in /public. That's fine.
    }

    /**
     * Exports the products to a PDF file.
     * @param array $products The list of products from the database.
     * @param string $filename The PDF file name.
     * @return void Returns nothing.
     */
    private function exportPDF(array $products, string $filename): void
    {
        // TODO: Create a HTML-Fragment (heading + table) for the products.
        //       You can create it in PHP (e.g, a Heredoc string) or write the fragment as a Twig template.
        //       If you use Twig, call render($template, $parameters) to render the template into a string.

        // TODO: Use HTML2PDF or just TCPDF and write the string with the HTML fragment into a PDF file.
        // TODO: Don't forget to set the PDF metadata.

        // TODO: Write the PDF in the /public directory. Beware: __DIR__ will give you the /src/HYP2UE07 directory.
        //       You can append /../ multiple times to go down a few directories from there again.
    }

    /**
     * Displays output (a response) by showing a Twig template.
     * @return void Returns nothing
     */
    public function displayOutput(): void
    {
        // TODO: Render the template "export.html.twig". It contains the placeholders "type" and "filename".
        //       Pass on the appropriate values.
        //       "type" is either XML, JSON or PDF, depending on which format was selected.
        //       Beware: The string value from the enum must be retrieved via $this->format->name.
        //       "filename" is the name of the file that was just created. If it is located in /public it will create
        //         a working link in the template so the file can be viewed.

        $this->twig->display("export.html.twig", [
            "type" => $this->format->name,
            "filename" => $this->filename
        ]);
    }
}
