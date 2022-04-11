
package control;

import java.sql.Connection;
import java.sql.DriverManager;
import javax.swing.JOptionPane;

public class ConnectDatabase {

    final static String JDBC_DRIVER ="org.mariadb.jdbc.Driver"; 
    final static String DB_URL ="jdbc:mariadb://localhost:3306/e-com";
    final static String USER ="root";
    final static String PASS ="";
    
    
    public static Connection connection () {
        
        try {
           Class.forName(JDBC_DRIVER);
           
           Connection conn = DriverManager.getConnection( DB_URL,USER,PASS );
            
           return conn;
        } catch ( Exception ex ) {
            
            JOptionPane.showMessageDialog(null, ex);
        }
        return null;
    }
    
}
