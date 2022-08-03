<?php
namespace Cli;

use Docopt;
use Docopt\Response;

function getAppArguments(): Response
{
    $doc = <<<DOCOPT
    Generate diff
    
    Usage:
      gendiff (-h|--help)
      gendiff (-v|--version)
      gendiff [--format <fmt>] <firstFile> <secondFile>
    
    Options:
      -h --help                     Show this screen
      -v --version                  Show version
      --format <fmt>                Report format [default: stylish]
    DOCOPT;

    return Docopt::handle($doc);
}
