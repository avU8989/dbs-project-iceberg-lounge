import java.lang.reflect.Array;
import java.util.ArrayList;

public class InsertTest {
    public static void main(String[] args){
        DatabaseHelper dbHelper = new DatabaseHelper();
        RandomHelper rHelper = new RandomHelper();
        System.out.println("----------------------------------------------------");
        System.out.println("Insert into PLZ");
        /*
        ArrayList<Integer> plz = rHelper.getPLZ();
        ArrayList<String> ort = rHelper.getOrt();
        for(int i = 0; i < plz.size(); ++i){
            dbHelper.insertIntoPLZ(plz.get(i), ort.get(i));
        }
         */
        System.out.println("----------------------------------------------------");
        System.out.println("Insert into persons");
/*
        for(int i = 0; i  < 3000; ++i){
            dbHelper.insertIntoPerson(rHelper.getRandomFirstName(), rHelper.getRandomLastName(), rHelper.getStreets().get(i), rHelper.getPLZ().get(rHelper.getRandomInteger(0,23)));
        }
*/
        System.out.println("----------------------------------------------------");
        System.out.println("Insert into customer");
/*
        ArrayList<Integer> person_ids = dbHelper.selectPersonIdFromPerson();
        ArrayList<String> phone_numbers = rHelper.generateRandomPhoneNumbers(400);
        ArrayList<String> emails = rHelper.getEmails();

        for(int i = 0; i < 400; ++i){
            dbHelper.insertIntoCustomer(person_ids.get(rHelper.getRandomInteger(0, person_ids.size()-1)),rHelper.getRandomIban(), phone_numbers.get(i));
        }
*/
        System.out.println("----------------------------------------------------");
        System.out.println("Insert into users");
/*
        ArrayList<Integer> customernumber_fk = dbHelper.selectCustomerIdsFromCustomer();
        int customer_counter = 0;
        for(int i : customernumber_fk){
            dbHelper.insertIntoUsers(customer_counter, emails.get(customer_counter), rHelper.getRandomUsername(), rHelper.getRandomPassword(), rHelper.getRandomDouble(0.0,1000.0,3), i);
            ++customer_counter;
        }

        if(customer_counter == dbHelper.selectNumberOfCustomers()){
            System.out.println("Customer count successful");
        }
*/
        System.out.println("----------------------------------------------------");
        System.out.println("Insert into workers");
/*
        ArrayList<Integer> person_id_fk = dbHelper.selectWorkerIdFromPerson();
        ArrayList<Integer> ssn = rHelper.getSSN();

        int worker_counter = 0;
        for(int i = 0; i < person_id_fk.size(); ++i){
            dbHelper.insertIntoWorker(person_id_fk.get(i), 0, rHelper.getRandomDouble(0,2700.0,2),ssn.get(i));
            ++worker_counter;
        }

        if(worker_counter == dbHelper.selectNumberOfWorkers()){
            System.out.println("Worker insertion successful");
        }
*/
        System.out.println("----------------------------------------------------");
        System.out.println("Insert into products");
/*
        ArrayList<String> files = rHelper.getFilenames();
        ArrayList<String> categories = rHelper.getCategories();
        ArrayList<String> anames = rHelper.getArticlenames();
        for(int i = 0; i < files.size()-1; ++i){
            dbHelper.insertIntoProducts(rHelper.getRandomDouble(100.00,999.99,2), categories.get(i), anames.get(i));
        }
*/
        System.out.println("----------------------------------------------------");
        System.out.println("Insert into products images");
/*
        ArrayList<String> files = rHelper.getFilenames();
        ArrayList<Integer> ids = dbHelper.selectProductIdsFromProducts();

        for(int i = 0; i < files.size()-1;++i){
            dbHelper.insertIntoProductImages(ids.get(i), files.get(i));
        }
*/


        dbHelper.close();
    }
}
