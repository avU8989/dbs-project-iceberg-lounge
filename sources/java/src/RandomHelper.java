//Database Systems (Module IDS) 

import java.io.BufferedReader;
import java.io.FileReader;
import java.util.ArrayList;
import java.util.Random;
import java.util.Scanner;

// The RandomHelper class wraps around the JAVA Random class to provide convenient access to random data as we need it
// Additionally it provides access to external single-columned files (e.g. courses.csv, names.csv, surnames.csv)
class RandomHelper {
    private final char[] alphabet = getCharSet();
    private Random rand;
    private ArrayList<String> firstNames;
    private ArrayList<String> lastNames;
    private ArrayList<Integer> plz;
    private ArrayList<String> streets;
    private ArrayList<String> ort;
    private ArrayList<String> iban;
    private ArrayList<String> emails;
    private ArrayList<String> username;
    private ArrayList<String> password;
    private ArrayList<Integer> socialSecurityNumbers;
    private ArrayList<String> filenames;
    private ArrayList<String> articlenames;
    private ArrayList<String> articlecategories;
    private static final String firstNameFile = "C:/Users/Anh/DBMS_Projekt/sources/java/src/names.csv"; //todo check directory
    private static final String lastNameFile = "C:/Users/Anh/DBMS_Projekt/sources/java/src/surnames.csv";
    private static final String streetsNameFile = "C:/Users/Anh/DBMS_Projekt/sources/java/src/streets.csv";
    private static final String plzFile = "C:/Users/Anh/DBMS_Projekt/sources/java/src/plz.csv";
    private static final String ortFile = "C:/Users/Anh/DBMS_Projekt/sources/java/src/ort.csv";
    private static final String ibanFile = "C:/Users/Anh/DBMS_Projekt/sources/java/src/iban.csv";
    private static final String emailFile = "C:/Users/Anh/DBMS_Projekt/sources/java/src/email.csv";
    private static final String usernameFile = "C:/Users/Anh/DBMS_Projekt/sources/java/src/username.csv";
    private static final String passwordFile = "C:/Users/Anh/DBMS_Projekt/sources/java/src/passwort.csv";
    private static final String filenamesFile = "C:/Users/Anh/DBMS_Projekt/sources/java/src/filenames.csv";
    private static final String categoriesFile = "C:/Users/Anh/DBMS_Projekt/sources/java/src/artikelkategorie.csv";
    private static final String articlenamesFile = "C:/Users/Anh/DBMS_Projekt/sources/java/src/articlenames.csv";

    //instantiate the Random object and store data from files in lists
    RandomHelper() {
        this.rand = new Random();
        this.lastNames = readFile(lastNameFile);
        this.firstNames = readFile(firstNameFile);
        this.streets = readFile(streetsNameFile);
        this.plz = readFileInt(plzFile);
        this.ort = readFile(ortFile);
        this.iban = readFile(ibanFile);
        this.emails = readFile(emailFile);
        this.password = readFile(passwordFile);
        this.username = readFile(usernameFile);
        this.filenames = readFile(filenamesFile);
        this.articlenames = readFile(categoriesFile);
        this.articlecategories = readFile(articlenamesFile);
        this.socialSecurityNumbers = generateRandomSocialSecurityNumbers(1000);
    }

    //not used but it might be helpful
    String getRandomString(int minLen, int maxLen) {
        StringBuilder out = new StringBuilder();
        int len = rand.nextInt((maxLen - minLen) + 1) + minLen;
        while (out.length() < len) {
            int idx = Math.abs((rand.nextInt() % alphabet.length));
            out.append(alphabet[idx]);
        }
        return out.toString();
    }

    //returns random element from firstName List
    String getRandomFirstName() {
        return firstNames.get(getRandomInteger(0, firstNames.size() - 1));
    }

    //returns random element from lastName list
    String getRandomLastName() {
        return lastNames.get(getRandomInteger(0, lastNames.size() - 1));
    }

    //return random element from iban list
    String getRandomIban() {return iban.get(getRandomInteger(0, iban.size() - 1)); }

    //return random element from email list
    String getRandomUsername() {return username.get(getRandomInteger(0, username.size() -1));}
    String getRandomPassword() {return password.get(getRandomInteger(0, password.size() -1));}
    Integer getRandomSSN() {return socialSecurityNumbers.get(getRandomInteger(0,socialSecurityNumbers.size()-1));}


    //returns random double from the Interval [min, max] and a defined precision (e.g. precision:2 => 3.14)
    Double getRandomDouble(double min, double max, int precision) {
        //Hack that is not the cleanest way to ensure a specific precision, but...
        double r = Math.pow(10, precision);
        return Math.round(min + (rand.nextDouble() * (max - min)) * r) / r;
    }

    //return random Integer from the Interval [min, max]; (min, max are possible as well)
    Integer getRandomInteger(int min, int max) {
        return rand.nextInt((max - min) + 1) + min;
    }

    ArrayList<Integer> getPLZ() {return plz;}
    ArrayList<String> getStreets() {return streets;}
    ArrayList<String> getOrt() {return ort;}
    ArrayList<Integer> getSSN() {return socialSecurityNumbers;}
    ArrayList<String> getEmails() {return emails;}
    ArrayList<String> getFilenames() {return filenames;}
    ArrayList<String> getCategories() {return articlecategories;}
    ArrayList<String> getArticlenames() {return articlenames;}


    ArrayList<Integer> generateRandomSocialSecurityNumbers(int size){
        ArrayList<Integer> ret = new ArrayList<>();
        int x,y,j;
        for(int i = 0; i < size; ++i){
            x = getRandomInteger(1000,9999);
            y = getRandomInteger(10000,99999);
            j = Integer.valueOf(String.valueOf(x) + String.valueOf(y));
            ret.add(j);
        }
        return ret;
    }

    ArrayList<String> generateRandomPhoneNumbers(int size){
        ArrayList<String> ret = new ArrayList<>();
        int y = 0;
        int j = 0;
        String k;
        for(int i = 0; i < size; ++i){
            y=getRandomInteger(650, 699);
            j=getRandomInteger(1000000,9999999);
            k = "0" + String.valueOf(y) + String.valueOf(j);
            ret.add(k);
        }
        return ret;
    }

    //reads single-column files and stores its values as Strings in an ArraList
    private ArrayList<String> readFile(String filename) {
        String line;
        ArrayList<String> set = new ArrayList<>();
        try (BufferedReader br = new BufferedReader(new FileReader(filename))) {
            while ((line = br.readLine()) != null) {
                try {
                    set.add(line);
                } catch (Exception ignored) {
                }
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
        return set;
    }

    //reads single-column files and stores its values as Ints in an ArrayList
    private ArrayList<Integer> readFileInt(String filename) {
        String line;
        ArrayList<Integer> set = new ArrayList<>();
        try (BufferedReader br = new BufferedReader(new FileReader(filename))) {
            while ((line = br.readLine()) != null) {
                try {
                    int value = Integer.parseInt(line);
                    set.add(value);
                } catch (Exception ignored) {
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
        return set;
    }

    //defines which chars are used to create random strings
    private char[] getCharSet() { // create getCharSet char array
        StringBuffer b = new StringBuffer(128);
        for (int i = 48; i <= 57; i++) b.append((char) i);        // 0-9
        for (int i = 65; i <= 90; i++) b.append((char) i);        // A-Z
        for (int i = 97; i <= 122; i++) b.append((char) i);       // a-z
        return b.toString().toCharArray();
    }
}