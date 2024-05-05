<?php

namespace HYP2UE07;

/**
 * Defines the possible export formats for the ProductExporter class.
 * @package HYP2UE07
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @version 2024
 */
enum ExportFormat
{
    case XML;
    case JSON;
    case PDF;
}
