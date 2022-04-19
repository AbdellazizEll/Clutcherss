/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.Clutchers.services;

import edu.Clutchers.entities.Categories;
import edu.Clutchers.entities.Produit;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import edu.Clutchers.utils.MyConnection;

/**
 *
 * @author sinda
 */
public class ProduitCRUD {
    
    Connection cnx2;
     
    public ProduitCRUD()
    {cnx2 = MyConnection.getInstance().getCnx();}
    
    
    
   
    
    public void ajouterProd(Produit p){
        try {
            String requete2 = "INSERT INTO produit (prix,nom,image,description,qte,cat_id) "
                    + "VALUES (?,?,?,?,?,?)";
            PreparedStatement pst = cnx2.prepareStatement(requete2);
            pst.setDouble(1,p.getPrix());
            pst.setString(2,p.getNom());
            pst.setString(3,p.getImage());
            pst.setString(4,p.getDescription());
            pst.setInt(5,p.getQte());
            pst.setInt(6,p.getCat_id());
            pst.executeUpdate();
             System.out.println("produit ajoutée  ");
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());  
        }
          
    
    }
    
   public List<Produit> afficherProd(){
        List<Produit> myList = new ArrayList<>();
       try {
            
            String requete3 = "SELECT p.* ,c.nom_c FROM `produit` p INNER join categories c on p.cat_id= c.id";
            Statement st =cnx2.createStatement();
            ResultSet rs = st.executeQuery(requete3);
            while(rs.next()){
            Produit p = new Produit();
            Categories c= new Categories();
            p.setId(rs.getInt(1));
            p.setPrix(rs.getDouble("prix"));
            p.setNom(rs.getString("nom"));
            p.setImage(rs.getString("image"));
            p.setDescription(rs.getString("description"));
            p.setQte(rs.getInt("qte"));
            p.setCat_id(rs.getInt("cat_id"));
           // c.setId(rs.getInt("cat_id"));
            c.setNom_c(rs.getString("c.nom_c"));
            //System.out.println( "id=" + p.getId() + ", prix=" + p.getPrix() + ", nom=" + p.getNom() + ", image=" + p.getImage() + ", description=" + p.getDescription() + ", qte=" + p.getQte() + ", categorie " + c.getNom_c() );
            myList.add(p);
            }
            
            
           
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
            
        }
         return myList;
   }
   
    public void modifierProd(Produit p) {
        try {
            String req = "update produit set prix = ? , nom = ? , image = ? , description = ? , qte = ? where id = ?";
            PreparedStatement pp = cnx2.prepareStatement(req);
            pp.setDouble(1, p.getPrix());
            pp.setString(2, p.getNom());
            pp.setString(3, p.getImage());
            pp.setString(4, p.getDescription());
            pp.setInt(5, p.getQte());
            pp.setInt(6, p.getId());
            
            
            pp.executeUpdate();
       
        
            
            
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        }
        
    }
    
     public void supprimerProd(int id) {
        try {
            String req = "delete from produit where id = ?";
            PreparedStatement ps = cnx2.prepareStatement(req);
            ps.setInt(1, id);
            ps.executeUpdate();
        } catch (SQLException ex) {
             System.err.println(ex.getMessage());
        }
    }
     
     
}


    

