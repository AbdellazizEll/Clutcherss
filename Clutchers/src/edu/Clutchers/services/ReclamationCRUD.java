/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.Clutchers.services;

import edu.Clutchers.entities.Reclamation;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;
import edu.Clutchers.utils.MyConnection;
import java.util.List;

/**
 *
 * @author sinda
 */
public class ReclamationCRUD {
    
    Connection cnx2;
     
    public ReclamationCRUD()
    {cnx2 = MyConnection.getInstance().getCnx();}
    
    
    
    public void ajouterRec(){
        try {
            String requete = "INSERT INTO reclamation (sujet,content,nom,email) "
                    + "VALUES ('b','b','b','b')";
            Statement st =cnx2.createStatement();
            st.executeUpdate(requete);
            System.out.println("Reclamation ajoutée avec succès ");
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
    }
    
    public void ajouterRec2(Reclamation r){
        try {
            String requete2 = "INSERT INTO reclamation (sujet,content,nom,email) "
                    + "VALUES (?,?,?,?)";
            PreparedStatement pst = cnx2.prepareStatement(requete2);
            pst.setString(1,r.getSujet());
            pst.setString(2,r.getContent());
            pst.setString(3,r.getNom());
            pst.setString(4,r.getEmail());
            pst.executeUpdate();
             System.out.println("Reclamation ajoutée  ");
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());  
        }
          
    
    }
    
   public List<Reclamation> afficherRec(){
        List<Reclamation> myList = new ArrayList<>();
       try {
            
            String requete3 = "SELECT * FROM reclamation ";
            Statement st =cnx2.createStatement();
            ResultSet rs = st.executeQuery(requete3);
            while(rs.next()){
            Reclamation r = new Reclamation();
            r.setId(rs.getInt(1));
            r.setSujet(rs.getString("sujet"));
            r.setContent(rs.getString("content"));
            r.setNom(rs.getString("nom"));
            r.setEmail(rs.getString("email"));
            r.setStatut(rs.getBoolean("statut"));
            myList.add(r);
            }
            
            
           
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
            
        }
         return myList;
   }
   
    public void modifier(Reclamation r) {
        try {
            String req = "update reclamation set statut = ? where id = ?";
            PreparedStatement ps = cnx2.prepareStatement(req);
            ps.setBoolean(1, r.getStatut());
            ps.setInt(2, r.getId());
            ps.executeUpdate();
            
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
        
    }
    
     public void supprimer(int id) {
        try {
            String req = "delete from reclamation where id = ?";
            PreparedStatement ps = cnx2.prepareStatement(req);
            ps.setInt(1, id);
            ps.executeUpdate();
        } catch (SQLException ex) {
             System.err.println(ex.getMessage());
        }
    }
}
