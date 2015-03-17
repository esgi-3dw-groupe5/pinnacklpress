   /**
     * Execute the specified query
     */
    public function query($query)
    {
        if (!is_string($query) || empty($query)) {
            throw new InvalidArgumentException('The specified query is not valid.');
        }
        // lazy connect to MySQL
        $this->connect();
        if (!$this->_result = mysqli_query($this->_link, $query)) {
            throw new RuntimeException('Error executing the specified query ' . $query . mysqli_error($this->_link));   
        }
        return $this->_result;
    }
   
    /**
     * Perform a SELECT statement
     */
    public function select($table, $where = ", $fields = '*', $order = '', $limit = null, $offset = null)
    {
        $query = 'SELECT ' . $fields . ' FROM ' . $table
               . (($where) ? ' WHERE ' . $where : ")
               . (($limit) ? ' LIMIT ' . $limit : ")
               . (($offset && $limit) ? ' OFFSET ' . $offset : ")
               . (($order) ? ' ORDER BY ' . $order : ");
        $this->query($query);
        return $this->countRows();
    }
   
    /**
     * Perform an INSERT statement
     */ 
    public function insert($table, array $data)
    {
        $fields = implode(',', array_keys($data));
        $values = implode(',', array_map(array($this, 'quoteValue'), array_values($data)));
        $query = 'INSERT INTO ' . $table . ' (' . $fields . ') ' . ' VALUES (' . $values . ')';
        $this->query($query);
        return $this->getInsertId();
    }
   
    /**
     * Perform an UPDATE statement
     */
    public function update($table, array $data, $where = ")
    {
        $set = array();
        foreach ($data as $field => $value) {
            $set[] = $field . '=' . $this->quoteValue($value);
        }
        $set = implode(',', $set);
        $query = 'UPDATE ' . $table . ' SET ' . $set
               . (($where) ? ' WHERE ' . $where : ");
        $this->query($query);
        return $this->getAffectedRows(); 
    }
   
    /**
     * Perform a DELETE statement
     */
    public function delete($table, $where = ")
    {
        $query = 'DELETE FROM ' . $table
               . (($where) ? ' WHERE ' . $where : ");
        $this->query($query);
        return $this->getAffectedRows();
    }