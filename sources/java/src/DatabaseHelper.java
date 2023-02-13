import java.sql.*;
import java.util.ArrayList;


// The DatabaseHelper class encapsulates the communication with our database
class DatabaseHelper {
    // Database connection info
    private static final String DB_CONNECTION_URL = "jdbc:oracle:thin:@oracle19.cs.univie.ac.at:1521:orclcdb";
    private static final String USER = "a12034611"; //TODO: use a + matriculation number
    private static final String PASS = "dbs22"; //TODO: use your password (default: dbs19)

    // The name of the class loaded from the ojdbc14.jar driver file
    //private static final String CLASSNAME = "oracle.jdbc.driver.OracleDriver";

    // We need only one Connection and one Statement during the execution => class variable
    private static Statement stmt;
    private static Connection con;
    private static PreparedStatement prep_stmt;

    private static int personCounter=20; //TODO: your task --> remove this counter
    private static int customerCounter=0;
    private static int workerCounter=0;
    private static int numUpd=0;
    
    //CREATE CONNECTION
    DatabaseHelper() {
        try {
            //Loads the class into the memory
            //Class.forName(CLASSNAME);

            // establish connection to database
            con = DriverManager.getConnection(DB_CONNECTION_URL, USER, PASS);
            stmt = con.createStatement();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    //INSERT INTO
    void insertIntoCustomer(int person_id, String iban, String phonenumber) {
        try {
            String sql = "INSERT INTO KUNDE (PERSON_ID, IBAN, TELEFONNUMMER) VALUES (?,?,?)";
            prep_stmt = con.prepareStatement(sql);
            prep_stmt.setInt(1,person_id);
            prep_stmt.setString(2,iban);
            prep_stmt.setString(3, phonenumber);
            prep_stmt.addBatch();
            prep_stmt.executeBatch();
        } catch (Exception e) {
            System.err.println("Error at: insertIntoCustomer\nmessage: " + e.getMessage());
        }
    }

    void insertIntoProducts(double preis, String bezeichnung, String typ) {
        try {
            String sql = "INSERT INTO ARTIKEL (PREIS, BEZEICHNUNG, TYP) VALUES (?,?,?)";
            prep_stmt = con.prepareStatement(sql);
            prep_stmt.setDouble(1, preis);
            prep_stmt.setString(2, bezeichnung);
            prep_stmt.setString(3, typ);
            prep_stmt.addBatch();
            prep_stmt.executeBatch();
        } catch (Exception e) {
            System.err.println("Error at: insertIntoProducts\nmessage: " + e.getMessage());
        }
    }

    void insertIntoProductImages(int product_id, String filename){
        try{
            String sql = "INSERT INTO ARTIKEL_BILD(ARTIKELNUMMER_FK, FILES) VALUES (?,?)";
            prep_stmt = con.prepareStatement(sql);
            prep_stmt.setInt(1, product_id);
            prep_stmt.setString(2, filename);
            prep_stmt.addBatch();
            prep_stmt.executeBatch();
        } catch (Exception e) {
            System.err.println("Error at: insertIntoProducts\nmessage: " + e.getMessage());
        }
    }

    void insertIntoPerson(String firstName, String lastName, String street, int plz){
        try{
            String sql = "INSERT INTO PERSON(VORNAME, NACHNAME, STRASSE, PLZ) VALUES ('" +
                    firstName +
                    "','" +
                    lastName +
                    "','" +
                    street +
                    "','" +
                    plz +
                    "')";
            stmt.addBatch(sql);
            stmt.executeBatch();
        } catch (Exception e) {
            System.err.println("Error at: insertIntoPerson\nmessage: " + e.getMessage());
        }
    }

    void insertIntoWorker(int person_id, int chef_id, double salary, int svnr) {
        if(chef_id == 0){
            String sql = "INSERT INTO MITARBEITER (person_id, einkommen, svnr) VALUES(?,?,?)";
            try{
                prep_stmt = con.prepareStatement(sql);
                prep_stmt.setInt(1,person_id);
                prep_stmt.setDouble(2,salary);
                prep_stmt.setInt(3,svnr);
                prep_stmt.addBatch();
                prep_stmt.executeBatch();
            } catch (Exception e) {
                System.err.println("Error at: insertIntoWorker\nmessage: " + e.getMessage());
            }
        }else{
            String sql = "INSERT INTO MITARBEITER (person_id, vorgesetzter, einkommen, svnr) VALUES(?,?,?,?)";
            try{
                prep_stmt = con.prepareStatement(sql);
                prep_stmt.setInt(1,person_id);
                prep_stmt.setInt(2,chef_id);
                prep_stmt.setDouble(3,salary);
                prep_stmt.setInt(4,svnr);
                prep_stmt.addBatch();
                prep_stmt.executeBatch();
            } catch (Exception e) {
                System.err.println("Error at: insertIntoWorker\nmessage: " + e.getMessage());
            }
        }
    }

    void insertIntoUsers(int user_id, String email, String username, String password, double balance, int knr){
        String sql = "INSERT INTO BENUTZER (BENUTZERID, BENUTZERNAME, PASSWORT, EMAIL, BENUTZERGUTHABEN, KUNDENNUMMER_FK) VALUES (?,?,?,?,?,?)";
        try{
            prep_stmt = con.prepareStatement(sql);
            prep_stmt.setInt(1, user_id);
            prep_stmt.setString(2, username);
            prep_stmt.setString(3, password);
            prep_stmt.setString(4, email);
            prep_stmt.setDouble(5, balance);
            prep_stmt.setInt(6,knr);
            prep_stmt.addBatch();
            prep_stmt.executeBatch();
        }
        catch (SQLException e){
            System.err.format("SQL State: %s\n%s", e.getSQLState(), e.getMessage());
        }
        catch (Exception e){
            System.err.println("Error at insertIntoUsers\n message: " + e.getMessage());
        }
    }

    void insertIntoSeller(String UID, String name, String branch, String street, int plz){
        try {
            String sql = "INSERT INTO VERKÄUFER (U_ID, NAME, BRANCHE, STRASSE, PLZ) VALUES (" +
                    "'" +
                    UID +
                    "','" +
                    name +
                    "', '" +
                    branch +
                    "', '" +
                    street +
                    "', '" +
                    plz +
                    "')";
            stmt.addBatch(sql);
            stmt.executeBatch();
        } catch (Exception e) {
            System.err.println("Error at: insertIntoSeller\nmessage: " + e.getMessage());
        }
    }

    void insertIntoStorage(int storageId, String street, int plz, int capacity){
        try {
            String sql = "INSERT INTO LAGER (lagernummer, strasse, plz, lagerkapazität) VALUES (" +
                    "'" +
                    storageId +
                    "','" +
                    street +
                    "', '" +
                    plz +
                    "', '" +
                    capacity +
                    "')";
            stmt.addBatch(sql);
            stmt.executeBatch();
        } catch (Exception e) {
            System.err.println("Error at: insertIntoStorage\nmessage: " + e.getMessage());
        }
    }

    void insertIntoReturns(int return_id, String date, int orderNumber){
        try {
            String sql = "INSERT INTO RÜCKSENDEGENEHMIGUNG (rsnummer, rsdatum, rsbestellnummer) VALUES (" +
                    "'" +
                    return_id +
                    "','" +
                    date +
                    "', '" +
                    orderNumber+
                    "')";
            stmt.addBatch(sql);
            stmt.executeBatch();
        } catch (Exception e) {
            System.err.println("Error at: insertIntoReturns\nmessage: " + e.getMessage());
        }
    }

    void insertIntoPLZ(int plz, String ort){
        try {
            String sql = "INSERT INTO PLZ (plz, ort) VALUES (?,?)";
            prep_stmt = con.prepareStatement(sql);
            prep_stmt.setInt(1,plz);
            prep_stmt.setString(2,ort);
            prep_stmt.addBatch();
            stmt.executeBatch();
        } catch (Exception e) {
            System.err.println("Error at:  insertIntoPLZ\nmessage: " + e.getMessage());
        }
    }

    void InsertIntoDiscount(String type, int discount){
        try {
            String sql = "INSERT INTO RABATT (atyp, rabatt) VALUES (" +
                    "'" +
                    type +
                    "','" +
                    discount +
                    "')";
            stmt.addBatch(sql);
            stmt.executeBatch();
        } catch (Exception e) {
            System.err.println("Error at:  insertIntoPLZ\nmessage: " + e.getMessage());
        }
    }

    //UPDATE
    void updateChefFromWorkers(int chef_ssn, int ssn){
        try{
            String sql = "UPDATE MITARBEITER SET VORGESETZTER=? WHERE SVNR=?";
            prep_stmt = con.prepareStatement(sql);
            prep_stmt.setInt(1,chef_ssn);
            prep_stmt.setInt(2, ssn);
            numUpd = prep_stmt.executeUpdate();
        } catch(Exception e){
            System.err.println("Error at: UpdateChefFromWorkers\nmessage: " + e.getMessage());
        }
    }

    //SELECT
    ArrayList<Integer> selectCustomerIdsFromCustomer() {
        ArrayList<Integer> IDs = new ArrayList<>();

        try {
            ResultSet rs = stmt.executeQuery("SELECT KNR FROM KUNDE ORDER BY KNR");
            while (rs.next()) {
                IDs.add(rs.getInt("KNR"));
            }
            rs.close();
        } catch (Exception e) {
            System.err.println(("Error at: selectCustomerIdsFromPerson\n message: " + e.getMessage()).trim());
        }
        return IDs;
    }

    ArrayList<Integer> selectProductIdsFromProducts() {
        ArrayList<Integer> IDs = new ArrayList<>();
        try {
            ResultSet rs = stmt.executeQuery("SELECT ARTIKELNUMMER FROM ARTIKEL ORDER BY ARTIKELNUMMER");
            while (rs.next()) {
                IDs.add(rs.getInt("ARTIKELNUMMER"));
            }
            rs.close();
        } catch (Exception e) {
            System.err.println(("Error at: selectpProductIdsFromProducts\n message: " + e.getMessage()).trim());
        }
        return IDs;
    }

    int selectNumberOfPerson(){
        //return the number of persons in our Table
       int result = 0;
        try{
            ResultSet rs = stmt.executeQuery("SELECT COUNT(*) AS total FROM PERSON");
            while(rs.next()){
                result = rs.getInt("total");
            }
            rs.close();
        } catch(Exception e){
            System.err.println(("Error at: selectNumberofPerson\nmessage: " + e.getMessage()).trim());
        }
        return result;
    }

    int selectNumberOfWorkers(){
        //return number of workes in Mitarbeiter table
        int result = 0;
        try{
            ResultSet rs = stmt.executeQuery("SELECT COUNT(*) AS total FROM MITARBEITER");
            while(rs.next()){
                result = rs.getInt("total");
            }
            rs.close();
        } catch (Exception e){
            System.err.println(("Error at: selectNumberOfWorkers\nmessage: " + e.getMessage()).trim());
        }
        return result;
    }

    int selectNumberOfCustomers(){
        int result = 0;
        try{
            ResultSet rs= stmt.executeQuery("SELECT COUNT(*) AS total FROM KUNDE");
            while(rs.next()){
                result = rs.getInt("total");
            }
            rs.close();
        } catch (Exception e){
            System.err.println(("Error at: selectNumberOfCustomers\nmessage: " + e.getMessage()).trim());
        }
        return result;
    }

    //returns the social security number from the workers
    ArrayList<Integer> selectSSNFromWorker() {
        ArrayList<Integer> IDs = new ArrayList<>();
        if(selectNumberOfWorkers() == 0){
            throw new RuntimeException("No workers in our table");
        }

        try{
            ResultSet rs = stmt.executeQuery("SELECT SVNR FROM MITARBEITER ORDER BY SVNR");
            while(rs.next()){
                IDs.add(rs.getInt("SVNR"));
            }
            rs.close();
        }catch (Exception e){
            System.err.println(("Error at: selectWorkerIdFromWorker\n message: " + e.getMessage()).trim());
        }

        return IDs;
    }

    //returns from the person List only a person, who is not a customer
    ArrayList<Integer> selectWorkerIdFromPerson(){
        ArrayList<Integer> IDs = new ArrayList<>();
        try{
            ResultSet rs = stmt.executeQuery("SELECT p.person_id FROM PERSON p left outer join KUNDE customer on customer.PERSON_ID = p.person_id WHERE customer.PERSON_ID is null");

            while(rs.next()){
                IDs.add(rs.getInt("PERSON_ID"));
            }
            rs.close();
        }catch (Exception e){
            System.err.println(("Error at: selectWorkerIdFromPerson\nmessage: " + e.getMessage()).trim());
        }
        return IDs;
    }

    //return person_id from table person
    ArrayList<Integer> selectPersonIdFromPerson(){
        ArrayList<Integer> IDs = new ArrayList<>();
        try{
            ResultSet rs = stmt.executeQuery("SELECT PERSON_ID FROM PERSON ORDER BY PERSON_ID");
            while(rs.next()){
                IDs.add(rs.getInt("PERSON_ID"));
            }
            rs.close();
        }catch (Exception e){
            System.err.println(("Error at: selectPersonIdFromPerson\n message: " + e.getMessage()).trim());
        }

        return IDs;
    }

    public void close()  {
        try {
            prep_stmt.close();
            stmt.close(); //clean up
            con.close();
        } catch (Exception ignored) {
        }
    }
}