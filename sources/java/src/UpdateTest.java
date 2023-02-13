import java.util.ArrayList;

public class UpdateTest {
    public static void main(String[] args){
        DatabaseHelper dBHelper = new DatabaseHelper();
        RandomHelper rHelper = new RandomHelper();

        System.out.println("----------------------------------------------------");
        System.out.println("Update chef_id from workers");
        for(int i = 0; i < 10; ++i){
            dBHelper.updateChefFromWorkers(dBHelper.selectSSNFromWorker().get(rHelper.getRandomInteger(0, dBHelper.selectNumberOfWorkers()-1)),dBHelper.selectSSNFromWorker().get(rHelper.getRandomInteger(0,dBHelper.selectNumberOfWorkers()-1)));
        }
    }
}
