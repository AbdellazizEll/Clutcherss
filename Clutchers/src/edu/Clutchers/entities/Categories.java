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
public class Categories {
    private int id;
    private String nom_c;

    public Categories(int id, String nom_c) {
        this.id = id;
        this.nom_c = nom_c;
    }

    public Categories(String nom_c) {
        this.nom_c = nom_c;
    }

    public Categories() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNom_c() {
        return nom_c;
    }

    public void setNom_c(String nom_c) {
        this.nom_c = nom_c;
    }

    @Override
    public String toString() {
        return "Categories{" + "id=" + id + ", nom_c=" + nom_c + '}';
    }
    
    
    
}
