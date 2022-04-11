package control;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;
import view.AdminLogin;
import view.Main;
import javax.swing.JOptionPane;
import net.proteanit.sql.DbUtils;
import view.AddUser;
import view.ModWebUser;

import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.StandardCharsets;
import java.util.Random;


public class MainControl implements ActionListener {
    
    Connection conn = null;
    Statement stmt =null;
    ResultSet rs = null;
    private AdminLogin ALoginfrm;
    private  Main Mainfrm;
    private AddUser Userfrm;
    private  ModWebUser Webfrm;
    public String Id;
    private String SessionId="";
    
    public MainControl() {
        conn =ConnectDatabase.connection();
        setDefaultMode();
        ComponentsBoundActionListener();
    }
    private void ComponentsBoundActionListener() {

        ALoginfrm.getLoginBtn().addActionListener( this );
        
        Mainfrm.getSearch().addActionListener( this ); 
        Mainfrm.getBlock().addActionListener( this );
        Mainfrm.getAllow().addActionListener( this );
        Mainfrm.getaddNewUser().addActionListener(this);
        Mainfrm.getModWebUser().addActionListener(this);
        
        Userfrm.getAddUser().addActionListener(this);
        Userfrm.getExit().addActionListener(this);
        
        Webfrm.getAddUser().addActionListener(this);
        Webfrm.getExit().addActionListener(this);
       
    }
    private void setDefaultMode() {
        
       ALoginfrm = new AdminLogin();
       ALoginfrm.setVisible( true );
       Mainfrm = new Main();
       Mainfrm.setVisible(false);
       Userfrm = new AddUser();
       Webfrm = new ModWebUser();       
    }
    private void start() throws Exception{
        Mainfrm.setVisible(true);
        ALoginfrm.dispose();
        ShowTable();
    }
    public void Login(){

        String User = ALoginfrm.getUserNameTf().getText();
        String Pass = ALoginfrm.getPassNameTf().getText();
        SessionId = RandomGenerator();
        
        try{

            URL url = new URL("http://localhost:8000/api/desktop-login");
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("POST");
            conn.setDoOutput(true);
            conn.setRequestProperty("Content-Type", "application/json");

            String data= "{\"UserName\":\""+User+"\",\"Password\":\""+Pass+"\",\"Sid\":\""+SessionId+"\"}";
            byte[] out = data.getBytes(StandardCharsets.UTF_8);

            OutputStream stream = conn.getOutputStream();
            stream.write(out);
            conn.connect();
            int responseCode = conn.getResponseCode();

            if(responseCode==404 || responseCode==500 ){
                ALoginfrm.setStatusLbl("Hibás Adatok");
            }
            if(responseCode == 200) {
                start();
            }
        }catch(Exception e){JOptionPane.showMessageDialog(null, "Http válasz: " + 500);}

    }
    public void ShowTable() throws Exception{      
        try{
            stmt =conn.createStatement();
            String sql = "SELECT `Email`, `UserName`, `Date`,`Text` FROM `authentication` INNER JOIN allow ON authentication.Allow = allow.Allow;";
            ResultSet res =stmt.executeQuery(sql);
            Mainfrm.getTbl().setModel(DbUtils.resultSetToTableModel(res));
        }catch (Exception e){JOptionPane.showMessageDialog(null, e);}
        /*URL url = new URL(" http://127.0.0.1:8000/api/desktop-all-user");
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        conn.setRequestMethod("POST");
        conn.setDoOutput(true);
        conn.setRequestProperty("Content-Type", "application/json");
        
        String data= "{}";
        byte[] out = data.getBytes(StandardCharsets.UTF_8);
        
        OutputStream stream = conn.getOutputStream();
        conn.connect();
        
        int responseCode = conn.getResponseCode();
        if(responseCode==404 || responseCode==500 ){
            
        }
        String text = "";
        if(responseCode == 200) {
            text = new String(
                conn.getInputStream().readAllBytes(), 
                StandardCharsets.UTF_8);
        }else {
            throw new RuntimeException("Http válasz: " + responseCode);
        }
        JsonObject jsonObject = new JsonParser().parse(text).getAsJsonObject();
        JsonObject APIdata = jsonObject.getAsJsonObject("data");
        
        System.err.println(APIdata);
        */
        
        
    }
    public void BlockUser (){
         try {
            int row = Mainfrm.getTbl().getSelectedRow();
            String User =Mainfrm.getTbl().getValueAt( row, 1 ).toString();
            
            URL url = new URL("http://localhost:8000/api/desktop-update-status-block");
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("POST");
            conn.setDoOutput(true);
            conn.setRequestProperty("Content-Type", "application/json");

            String data= "{\"UserName\":\""+User+"\",\"Sid\":\""+SessionId+"\"}";
            byte[] out = data.getBytes(StandardCharsets.UTF_8);

            OutputStream stream = conn.getOutputStream();
            stream.write(out);
            conn.connect();
            int responseCode = conn.getResponseCode();

            if(responseCode==404 || responseCode==500 ){
            }
            if(responseCode == 200) {
                String UserName = Mainfrm.getSUser().getText();
                if(UserName.length() <1){
                    ShowTable();
                }else{
                    SearchUser();
                }
            }else {
                throw new RuntimeException("Http válasz: " + responseCode);
            }
        } catch (Exception e){JOptionPane.showMessageDialog(null, "Nincs kiválaszott sor!");
        }
    }
    public void AllowUser (){
        try {
            int row = Mainfrm.getTbl().getSelectedRow();
            String User =Mainfrm.getTbl().getValueAt( row, 1 ).toString();
            
            URL url = new URL("http://localhost:8000/api/desktop-update-status-active");
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("POST");
            conn.setDoOutput(true);
            conn.setRequestProperty("Content-Type", "application/json");

            String data= "{\"UserName\":\""+User+"\",\"Sid\":\""+SessionId+"\"}";
            byte[] out = data.getBytes(StandardCharsets.UTF_8);

            OutputStream stream = conn.getOutputStream();
            stream.write(out);
            conn.connect();

            int responseCode = conn.getResponseCode();

            if(responseCode==404 || responseCode==500 ){
            }
            if(responseCode == 200) {
                String UserName = Mainfrm.getSUser().getText();
                if(UserName.length() <1){
                    ShowTable();
                }else{
                    SearchUser();
                }
            }else {
                throw new RuntimeException("Http válasz: " + responseCode);
            }            
        }catch (Exception e){JOptionPane.showMessageDialog(null, "Nincs kiválaszott sor!");
        }
    }
    public void SearchUser () throws Exception{
        String User = Mainfrm.getSUser().getText();
        if(User.length() <1){
            ShowTable();
        }else{
            try{
            stmt =conn.createStatement();
            String sql = "SELECT `Email`, `UserName`, `Date`,`Text` FROM `authentication` INNER JOIN allow ON authentication.Allow = allow.Allow WHERE UserName = '"+User+"';";
            ResultSet res =stmt.executeQuery(sql);
            Mainfrm.getTbl().setModel(DbUtils.resultSetToTableModel(res));
            }catch (Exception e){JOptionPane.showMessageDialog(null, e);}
        }
    }
    public void GetAdmin(){
        String Admin = Userfrm.getUserName().getText();
        String Pass = Userfrm.getUserPassword().getText();
        
        if(Admin.length() > 8 && Pass.length()>8){          
            try{
                URL url = new URL("http://localhost:8000/api/desktop-create-user");
                HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                conn.setRequestMethod("POST");
                conn.setDoOutput(true);
                conn.setRequestProperty("Content-Type", "application/json");

                String data= "{\"UserName\":\""+Admin+"\",\"Password\":\""+Pass+"\",\"Sid\":\""+SessionId+"\"}";
                byte[] out = data.getBytes(StandardCharsets.UTF_8);

                OutputStream stream = conn.getOutputStream();
                stream.write(out);
                conn.connect();
                int responseCode = conn.getResponseCode();

                if(responseCode==404 || responseCode==500 ){

                }
                if(responseCode == 200) {
                    exit();
                }else {
                    throw new RuntimeException("Http válasz: " + responseCode);
                }
            }catch (Exception e){JOptionPane.showMessageDialog(null, e);}
        }
    }
    public void ShowUserFrame(){
        Userfrm.setVisible( true ); 
    }
    public void exit(){
        Userfrm.setVisible(false);
        Userfrm.getUserName().setText("");
        Userfrm.getUserPassword().setText("");
    }
    public void showWebFrameAndMore(){
        try {
            int row = Mainfrm.getTbl().getSelectedRow();
            String Username =Mainfrm.getTbl().getValueAt( row, 1 ).toString();
            String Useremail =Mainfrm.getTbl().getValueAt( row, 0 ).toString();
            Webfrm.setVisible( true );
            Webfrm.getUserName().setText(Username);
            Webfrm.getEmail().setText(Useremail);
            stmt =conn.createStatement();
            String sql ="SELECT Id From authentication WHERE UserName='"+Username+"' ";
            ResultSet rs =stmt.executeQuery(sql);
            while ( rs.next() ) {
                Id = rs.getString("Id");
            }
        } catch (Exception e){JOptionPane.showMessageDialog(null, "Nincs kiválaszott sor!");
        }
    }
    public void webexit(){
        Webfrm.setVisible(false);
    }
    public void ModWebUser(){
        String Username =Webfrm.getUserName().getText();
        String Useremail =Webfrm.getEmail().getText();
        try {
            URL url = new URL(" http://127.0.0.1:8000/api/desktop-update-user-data");
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("POST");
            conn.setDoOutput(true);
            conn.setRequestProperty("Content-Type", "application/json");

            String data= "{\"Id\":\""+Id+"\",\"UserName\":\""+Username+"\",\"Email\":\""+Useremail+"\",\"Sid\":\""+SessionId+"\"}";
            byte[] out = data.getBytes(StandardCharsets.UTF_8);

            OutputStream stream = conn.getOutputStream();
            stream.write(out);

            conn.connect();

            int responseCode = conn.getResponseCode();

            if(responseCode==404 || responseCode==500 ){
            }
            if(responseCode == 200) {
                Webfrm.getUserName().setText("");
                Webfrm.getEmail().setText("");
                webexit();
                ShowTable();
            }else {
                throw new RuntimeException("Http válasz: " + responseCode);
            }
        } catch (Exception e){JOptionPane.showMessageDialog(null, e);
        }
    }
    public String RandomGenerator(){
        String RandomId="";
        Random number = new Random();
        for(int counter = 1; counter<=32; counter++){
            RandomId += String.valueOf(number.nextInt(15));
        }
        return RandomId;
    }
    @Override
    public void actionPerformed( ActionEvent event ) {
            if( event.getSource() == ALoginfrm.getLoginBtn()) {
                Login();
            }else if (event.getSource() == Mainfrm.getSearch()){ 
                try {
                    SearchUser();
                } catch (Exception ex) {
                    JOptionPane.showMessageDialog(null, "Hiba történt a folyamat során");
                }
            }else if (event.getSource() == Mainfrm.getBlock()){
                BlockUser();
            }else if (event.getSource() == Mainfrm.getAllow()){  
                AllowUser();
            }else if (event.getSource() == Mainfrm.getaddNewUser()){  
                ShowUserFrame();
            }else if(event.getSource() == Mainfrm.getModWebUser()){
                showWebFrameAndMore();
            }else if (event.getSource() == Userfrm.getExit()){  
                exit();
            }else if (event.getSource() == Userfrm.getAddUser()){  
                GetAdmin();
            }else if (event.getSource() == Webfrm.getExit()){  
                webexit();
            }else if (event.getSource() == Webfrm.getAddUser()){  
                ModWebUser();
            }
    }
}
 

   
    

