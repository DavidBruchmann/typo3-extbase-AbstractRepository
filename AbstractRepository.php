<?php

namespace Vendor\ExtensionSignature\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class AbstractRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    protected function debugQuery($query, $result = null, $debugHeader = ''): void
    {
        $dbParser = GeneralUtility::makeInstance(Typo3DbQueryParser::class);
        $doctrineQueryBuilder = $dbParser->convertQueryToDoctrineQueryBuilder($query);
        $sql = $doctrineQueryBuilder->getSQL();
        $parameters = $doctrineQueryBuilder->getParameters();
        $debugHeader .= ($debugHeader ? ' // ' : '') . __METHOD__ . ':' . __LINE__;
        DebuggerUtility::var_dump([
            'sql' => $sql,
            'parameters' => $parameters,
            'result' => $result,
            // 'backtrace' => debug_backtrace(),
        ], $debugHeader);
    }
}
