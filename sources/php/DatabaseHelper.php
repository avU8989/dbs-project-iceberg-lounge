<?php

class DatabaseHelper
{
    // Since the connection details are constant, define them as const
    // We can refer to constants like e.g. DatabaseHelper::username
    const username = 'a12034611'; // use a + your matriculation number
    const password = 'dbs22'; // use your oracle db password
    const con_string = 'oracle19.cs.univie.ac.at:1521/orclcdb';  //on almighty "lab" is sufficient

    // Since we need only one connection object, it can be stored in a member variable.
    // $conn is set in the constructor.
    protected $conn;

    // Create connection in the constructor
    public function __construct()
    {
        try {
            // Create connection with the command oci_connect(String(username), String(password), String(connection_string))
            // The @ sign avoids the output of warnings
            // It could be helpful to use the function without the @ symbol during developing process
            $this->conn = @oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string
            );

            //check if the connection object is != null
            if (!$this->conn) {
                // die(String(message)): stop PHP script and output message:
                die("DB error: Connection can't be established!");
            }
        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }

    // Used to clean up
    public function __destruct()
    {
        // clean up
        @oci_close($this->conn);
    }

    // This function creates and executes a SQL select statement and returns an array as the result
    // 2-dimensional array: the result array contains nested arrays (each contains the data of a single row)
    public function selectFromPersonWhere($person_id, $surname, $name)
    {
        // Define the sql statement string
        // Notice that the parameters $person_id, $surname, $name in the 'WHERE' clause
        $sql = "SELECT * FROM person
            WHERE person_id LIKE '%{$person_id}%'
              AND upper(surname) LIKE upper('%{$surname}%')
              AND upper(name) LIKE upper('%{$name}%')
            ORDER BY PERSON_ID ASC";

        // oci_parse(...) prepares the Oracle statement for execution
        // notice the reference to the class variable $this->conn (set in the constructor)
        $statement = @oci_parse($this->conn, $sql);

        // Executes the statement
        @oci_execute($statement);

        // Fetches multiple rows from a query into a two-dimensional array
        // Parameters of oci_fetch_all:
        //   $statement: must be executed before
        //   $res: will hold the result after the execution of oci_fetch_all
        //   $skip: it's null because we don't need to skip rows
        //   $maxrows: it's null because we want to fetch all rows
        //   $flag: defines how the result is structured: 'by rows' or 'by columns'
        //      OCI_FETCHSTATEMENT_BY_ROW (The outer array will contain one sub-array per query row)
        //      OCI_FETCHSTATEMENT_BY_COLUMN (The outer array will contain one sub-array per query column. This is the default.)
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        @oci_free_statement($statement);

        return $res;
    }

    public function selectFromUserLikeEmail($email)
    {
        $sql = "SELECT * FROM BENUTZER
        WHERE email LIKE '%{$email}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $user = oci_fetch_array($statement, OCI_BOTH);
        @oci_free_statement($statement);
        return $user;
    }

    public function selectPersonIdLikeName($vorname, $nachname)
    {
        $sql = "SELECT * FROM PERSON
        WHERE upper(vorname) LIKE upper('%{$vorname}%') AND upper(nachname) LIKE upper('%{$nachname}%')";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $user = oci_fetch_array($statement, OCI_BOTH);
        @oci_free_statement($statement);
        return $user;
    }
    

    public function selectKNrFromCustomerLikePersonId($person_id)
    {
        $sql = "SELECT KNr FROM KUNDE
        WHERE person_id LIKE '%{$person_id}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $user = oci_fetch_array($statement, OCI_BOTH);
        @oci_free_statement($statement);
        return $user;
    }

    public function selectQuantityFromShoppingCart($product_id, $customer_id)
    {
        $sql = "SELECT MENGE FROM WARENKORB
        WHERE ARTIKELNUMMER_FK LIKE '%{$product_id}%' AND KUNDE_FK LIKE '%{$customer_id}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $quantity = oci_fetch_array($statement, OCI_BOTH);
        @oci_free_statement($statement);
        return $quantity;
    }

    public function selectPersonIdFromCustomer($customer_id){
        $sql = "SELECT person_id FROM KUNDE 
        WHERE KNR LIKE '%{$customer_id}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $ret = oci_fetch_array($statement, OCI_BOTH);
        @oci_free_statement($statement);
        return $ret;
    }

    
    public function selectPerson($person_id){
        $sql = "SELECT* FROM PERSON
        WHERE person_id LIKE '%{$person_id}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $ret = oci_fetch_array($statement, OCI_BOTH);
        @oci_free_statement($statement);
        return $ret;
    }



    public function selectKNrFromUser($user_id)
    {
        $sql = "SELECT kundennummer_fk FROM BENUTZER
        WHERE benutzerid LIKE $user_id";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $user = oci_fetch_array($statement, OCI_BOTH);
        @oci_free_statement($statement);
        return $user;
    }

    public function selectProductByID($code)
    {
        $sql = "SELECT* FROM ARTIKEL
        WHERE artikelnummer LIKE '%{$code}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $product = oci_fetch_array($statement, OCI_BOTH);
        @oci_free_statement($statement);
        return $product;
    }

    public function selectProductByName($productname)
    {
        $sql = "SELECT* FROM ARTIKEL
        WHERE bezeichnung LIKE '%{$productname}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $product = oci_fetch_array($statement, OCI_BOTH);
        @oci_free_statement($statement);
        return $product;
    }

    public function selectOrderIdLikeDateAndCustomerId($customer_id, $date)
    {
        $sql = "SELECT bestellnummer FROM BESTELLUNG
        WHERE bestelldatum LIKE '%{$date}%'
        AND bestellknr LIKE '%{$customer_id}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $order = oci_fetch_array($statement, OCI_BOTH);
        @oci_free_statement($statement);
        return $order;
    }

    public function selectOrders($customer_id)
    {
        $sql = "SELECT* FROM BESTELLUNG
        WHERE bestellknr LIKE '%{$customer_id}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);
        return $res;
    }

    public function selectProducts()
    {
        $sql = "SELECT* FROM ARTIKEL ORDER BY artikelnummer";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);
        return $res;
    }

    public function selectProductFromOrderedItems($order_id)
    {
        $sql = "SELECT* FROM BESTELLTE_ARTIKEL WHERE bestellnummer_fk LIKE '%{$order_id}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);
        return $res;
    }

    public function selectProductIdsFromOrderedItems($order_id){
        $sql = "SELECT artikelnummer_fk FROM BESTELLTE_ARTIKEL WHERE bestellnummer_fk LIKE '%{$order_id}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);
        return $res;
    }

    public function selectProductFromShoppingCart($customer_id, $product_id)
    {
        $sql = "SELECT* FROM WARENKORB WHERE kunde_fk LIKE '%{$customer_id}%' AND artikelnummer_fk LIKE '%{$product_id}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $product = oci_fetch_array($statement, OCI_BOTH);
        @oci_free_statement($statement);
        return $product;
    }

    public function selectProductsFromShoppingCart($customer_id)
    {
        $sql = "SELECT* FROM WARENKORB WHERE kunde_fk LIKE '%{$customer_id}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);
        return $res;
    }

    public function selectProductIdsFromShoppingCart($customer_id){
        $sql = "SELECT artikelnummer_fk FROM WARENKORB WHERE kunde_fk LIKE '%{$customer_id}%'";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);
        return $res;
    }

    public function selectProductFiles($product_id){
        $sql = "SELECT files FROM ARTIKEL_BILD WHERE artikelnummer_fk LIKE $product_id";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);
        return $res;
    }

    public function quantityOfShoppingCart($customer_id){
        $sql = "SELECT SUM(MENGE)
        FROM WARENKORB
        WHERE kunde_fk LIKE '$customer_id'";
        $statement = oci_parse($this->conn, $sql);
        @oci_execute($statement);
        $quantity = oci_fetch_array($statement, OCI_BOTH);
        @oci_free_statement($statement);
        return $quantity;
    }


    public function updatePassword($password, $email)
    {
        $sql = "UPDATE BENUTZER SET PASSWORT= :passwort WHERE EMAIL= :email";
        $statement = @oci_parse($this->conn, $sql);
        @oci_bind_by_name($statement, ':passwort', $password);
        @oci_bind_by_name($statement, ':email', $email);
        $success = @oci_execute($statement, OCI_COMMIT_ON_SUCCESS);
        @oci_free_statement($statement);
        return $success;
    }

    public function updateQuantityinShoppingCart($quantity, $customer_id, $product_id){
        $sql = "UPDATE WARENKORB SET MENGE = :menge WHERE KUNDE_FK = :customer AND ARTIKELNUMMER_FK = :product_id";
        $sql2 = 'BEGIN delete_quantity_0(:product_id); END;';
        $statement = @oci_parse($this->conn, $sql);
        $statement2 = @oci_parse($this->conn, $sql2);
        @oci_bind_by_name($statement, ':menge', $quantity);
        @oci_bind_by_name($statement, ':customer', $customer_id);
        @oci_bind_by_name($statement, ':product_id', $product_id);
        @oci_bind_by_name($statement2, ':product_id', $product_id);
        @oci_execute($statement, OCI_COMMIT_ON_SUCCESS);
        $success = @oci_execute($statement2, OCI_COMMIT_ON_SUCCESS);
        @oci_free_statement($statement);
        @oci_free_statement($statement2);
        return $success;

    }

    // This function creates and executes a SQL insert statement and returns true or false
    public function insertIntoPerson($vorname, $nachname, $strasse, $plz)
    {
        $sql = "INSERT INTO PERSON (VORNAME, NACHNAME, STRASSE, PLZ) VALUES (:vorname, :nachname, :strasse, :plz)";

        $statement = @oci_parse($this->conn, $sql);
        @oci_bind_by_name($statement, ':vorname', $vorname);
        @oci_bind_by_name($statement, ':nachname', $nachname);
        @oci_bind_by_name($statement, ':strasse', $strasse);
        @oci_bind_by_name($statement, ':plz', $plz);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoOrder($date, $customer_id)
    {
        $sql = "INSERT INTO BESTELLUNG (BESTELLDATUM, BESTELLKNR) VALUES (:datum, :customer_id)";

        $statement = @oci_parse($this->conn, $sql);
        @oci_bind_by_name($statement, ':datum', $date);
        @oci_bind_by_name($statement, ':customer_id', $customer_id);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoShoppingCart($product_id, $customer_id, $quantity)
    {
        $sql = "INSERT INTO WARENKORB (ARTIKELNUMMER_FK, KUNDE_FK, MENGE) VALUES (:product_id, :customer, :quantity)";

        $statement = @oci_parse($this->conn, $sql);
        @oci_bind_by_name($statement, ':product_id', $product_id);
        @oci_bind_by_name($statement, ':customer', $customer_id);
        @oci_bind_by_name($statement, ':quantity', $quantity);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoOrderedItems($order_id, $product_id, $quantity, $delivery, $code)
    {
        $sql = "INSERT INTO BESTELLTE_ARTIKEL (BESTELLNUMMER_FK, ARTIKELNUMMER_FK, MENGE, VERSANDKOSTEN, CODE) VALUES (:order_id, :product_id, :quantity, :delivery, :code)";
        $statement = @oci_parse($this->conn, $sql);
        @oci_bind_by_name($statement, ':order_id', $order_id);
        @oci_bind_by_name($statement, ':product_id', $product_id);
        @oci_bind_by_name($statement, ':quantity', $quantity);
        @oci_bind_by_name($statement, ':delivery', $delivery);
        @oci_bind_by_name($statement, ':code', $code);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoCustomer($person_id, $iban, $telefonnummer)
    {
        $sql = "INSERT INTO KUNDE (PERSON_ID, IBAN, TELEFONNUMMER) VALUES (:person_id, :iban, :telefonnummer)";

        $statement = @oci_parse($this->conn, $sql);
        @oci_bind_by_name($statement, ':person_id', $person_id);
        @oci_bind_by_name($statement, ':iban', $iban);
        @oci_bind_by_name($statement, ':telefonnummer', $telefonnummer);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoUser($benutzername, $passwort, $email, $benutzerguthaben = 0, $kundennummer)
    {
        $sql = "INSERT INTO BENUTZER (BENUTZERNAME, PASSWORT, EMAIL, BENUTZERGUTHABEN, KUNDENNUMMER_FK) VALUES (:username,:password,:email,:balance, :kundennummer)";

        $statement = @oci_parse($this->conn, $sql);
        @oci_bind_by_name($statement, ':username', $benutzername);
        @oci_bind_by_name($statement, ':password', $passwort);
        @oci_bind_by_name($statement, ':balance', $benutzerguthaben);
        @oci_bind_by_name($statement, ':email', $email);
        @oci_bind_by_name($statement, ':balance', $benutzerguthaben);
        @oci_bind_by_name($statement, ':kundennummer', $kundennummer);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    // Using a Procedure
    // This function uses a SQL procedure to delete a person and returns an errorcode (&errorcode == 1 : OK)
    public function deleteProductFromCart($product_id, $customer_id)
    {
        $sql = "DELETE FROM WARENKORB WHERE artikelnummer_fk LIKE '%{$product_id}%' AND kunde_fk LIKE '%{$customer_id}%'";
        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }

    public function deleteFromCart($customer_id)
    {
        $sql = "DELETE FROM WARENKORB WHERE kunde_fk LIKE '%{$customer_id}%'";
        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }

    public function deletePerson($person_id){
        $sql = "DELETE FROM PERSON WHERE person_id LIKE '%{$person_id}%'";
        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }

    public function selectOrderIdFromCart($customer_id){
        $sql = "SELECT* FROM WARENBKORB WHERE KUNDE_FK LIKE '%{$customer_id}%'";
        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);
        $ret = oci_fetch($statement);
        oci_free_statement($statement);
        return $ret;
    }

    public function deleteOrder($order_id){
        $sql = "DELETE FROM BESTELLUNG WHERE bestellnummer = '$order_id'";
        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }

    // NOT IN USE - ALTERNATIVE to a simple insert (method return person_id)
    // using a Procedure to add a Person -> the Id of the currently added Person is return (otherwise false)
    public function addPerson($name, $surname)
    {
        $person_id = -1;
        $sql = 'BEGIN P_ADD_PERSON(:name, :surname, :person_id); END;';
        $statement = @oci_parse($this->conn, $sql);

        @oci_bind_by_name($statement, ':name', $name);
        @oci_bind_by_name($statement, ':surname', $surname);
        @oci_bind_by_name($statement, ':person_id', $person_id);


        if (!@oci_execute($statement)) {
            @oci_commit($this->conn);
        }
        @oci_free_statement($statement);

        return $person_id;
    }
}
