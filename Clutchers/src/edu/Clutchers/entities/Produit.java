/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.Clutchers.entities;

/**
 *
 * @author sinda
 */
public class Produit {
   private int id;
   private double prix;
   private String nom;
   private String image;
   private String description;
   private int qte;
   private int cat_id;
   

    public Produit(double prix, String nom, String image, String description, int qte,int cat_id) {
        this.prix = prix;
        this.nom = nom;
        this.image = image;
        this.description = description;
        this.qte = qte;
        this.cat_id=cat_id;
    }

  
    
    
    public Produit(int id, double prix, String nom, String image, String description, int qte , int cat_id) {
        this.id = id;
        this.prix = prix;
        this.nom = nom;
        this.image = image;
        this.description = description;
        this.qte = qte;
        this.cat_id=cat_id;
    }

    public Produit() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public double getPrix() {
        return prix;
    }

    public void setPrix(double prix) {
        this.prix = prix;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public int getQte() {
        return qte;
    }

    public void setQte(int qte) {
        this.qte = qte;
    }

    public int getCat_id() {
        return cat_id;
    }

    public void setCat_id(int cat_id) {
        this.cat_id = cat_id;
    }
    

    @Override
    public String toString() {
        return "Produit{" + "id=" + id + ", prix=" + prix + ", nom=" + nom + ", image=" + image + ", description=" + description + ", qte=" + qte + ", cat_id=" + cat_id + '}';
    }

    
   
   
   
   
    
    
    
    
}
