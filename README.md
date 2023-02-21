# typo3-extbase-AbstractRepository
Easy debugging of database-queries

IMPORTANT:  
use the branch that is fitting to your TYPO3 version.  
So v9 is fitting to TYPO3 v9 and as there is no v10, its working for TYPO3 v10 too.

## How to use?
 1. copy the class file AbstractRepository.php in your extension's Repository folder
 2. in your own repository files extend the class(es) by AbstractRepository
    ```
    class MyClass extends AbstractRepository
    {
        ...
    }
    ```
 3. in all methods that use or return an instance of
    `TYPO3\CMS\Extbase\Persistence\Generic\QueryResult` you can add a call to
    `$this->debugQuery()` and comment it out, so if you need it, you just remove the
    signs that mark it as comment:
    ```
    /**
     * Gets the top 3 newest Something Elements sorted descending by crdate
     *
     * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult<Something>
     */
    public function findSomething() : QueryResult
    {
        $query = $this->createQuery();
        $query->setOrderings(['crdate' => QueryInterface::ORDER_DESCENDING]);
        $query->setLimit(3);
        /** @var QueryResult $result */
        $result = $query->execute();
        # $this->debugQuery($query, $result, __METHOD__ . ':' . __LINE__);
        return $result;
    }
    ```
 4. The debug messages in Frontend will show the query, the parameters and above
    as header the method and line, as well as method and line in the AbstractRepository.
