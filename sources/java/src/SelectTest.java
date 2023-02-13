import java.util.ArrayList;

public class SelectTest {
    public static void main(String[] args) {
        DatabaseHelper dbHelper = new DatabaseHelper();
        RandomHelper rHelper = new RandomHelper();

        int result = dbHelper.selectNumberOfPerson();
        System.out.println(result);
/*
        ArrayList<Integer> customernumber = dbHelper.selectCustomerIdsFromCustomer();
        System.out.println("----------------------------------------------------");
        System.out.println("Customer Number IDs from Customer Table");
        for(int i : customernumber){
            System.out.println(i);
        }
*/
        ArrayList<Integer> workerIdFromPerson = dbHelper.selectWorkerIdFromPerson();
        System.out.println("----------------------------------------------------");
        System.out.println("PersonID from person table who are not Customers");
        for(int i : workerIdFromPerson){
            System.out.println(i);
        }

    }
}
