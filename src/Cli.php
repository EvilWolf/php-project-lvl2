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
    
    Options:
      -h --help                     Show this screen
      -v --version                  Show version
    DOCOPT;

    return Docopt::handle($doc);
}
