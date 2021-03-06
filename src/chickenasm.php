<?php

namespace igorw\chicken;

use Functional as F;

/** @api */
function chickenasm_to_eggsembler($code) {
    $lines = explode("\n", $code);
    $lines = F\map($lines, __NAMESPACE__.'\\translate_chickenasm_line');
    return implode("\n", $lines);
}

function translate_chickenasm_line($line) {
    if (0 === strpos($line, '#') || '' === $line) {
        return $line;
    }

    if (preg_match('#^push (\d+)$#', $line)) {
        return $line;
    }

    $mapping = [
        'exit'      => 'axe',
        'chicken'   => 'chicken',
        'add'       => 'add',
        'subtract'  => 'fox',
        'multiply'  => 'rooster',
        'compare'   => 'compare',
        'load'      => 'pick',
        'store'     => 'peck',
        'jump'      => 'fr',
        'char'      => 'bbq',
    ];

    if (isset($mapping[$line])) {
        return $mapping[$line];
    }

    throw new \InvalidArgumentException(sprintf("Did not recognize ChickenASM instruction '%s'", $line));
}
