/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.Clutchers.tests;

import edu.Clutchers.entities.Categories;
import edu.Clutchers.entities.Produit;
import edu.Clutchers.entities.Reclamation;
import edu.Clutchers.services.CategoriesCrud;
import edu.Clutchers.services.ProduitCRUD;
import edu.Clutchers.services.ReclamationCRUD;
import edu.Clutchers.utils.MyConnection;

/**
 *
 * @author sinda
 */
public class MainClass {
    public static void main(String[] args){
      MyConnection mc = MyConnection.getInstance();
      MyConnection mc2 = MyConnection.getInstance();
      System.out.println(mc.hashCode()+"-"+mc2.hashCode() );
    
     /* ReclamationCRUD pcd = new ReclamationCRUD();
      Reclamation r2 = new Reclamation("b","c","sinda","e");
     pcd.ajouterRec2(r2);
     System.out.println(pcd.afficherRec());
     pcd.modifier(r2);
    pcd.supprimer(15);
      
     
     Categories C = new Categories("mariouma");
     CategoriesCrud cc = new CategoriesCrud();
     cc.ajouterCategories(C);
     cc.supprimer(12);
     System.out.println(cc.afficherCategories());*/
     
     //ProduitCRUD pc = new ProduitCRUD();
    // Produit p = new Produit(2,"pc","pc","pc",23,7);
     //pc.ajouterProd(p);
     //pc.supprimerProd(29);
     //System.out.println(pc.afficherProd());
     
     
     
    }
     

}
    

