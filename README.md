# TSP problem for SerresHack 2018

## Part B

### 01: Serres -> Adelfiko (more than once to Adelfiko)

```
km: 54.008
Loops: 13
Path:
Serres
Provatas
Ano_Kamila
Kato_Mitrousi
Koumaria
Kato_Kamila
Skoutari
Agia_Eleni
Peponia
Adelfiko
```

### 02: Serres -> Adelfiko (only once to Adelfiko)

```
km: 54.008
Loops: 13
Path:
Serres
Provatas
Ano_Kamila
Kato_Mitrousi
Koumaria
Kato_Kamila
Skoutari
Agia_Eleni
Peponia
Adelfiko
```

### 03: Serres -> (through Koumaria, Peponia, Provatas, Skoutari) -> Adelfiko

```
km: 46.964
Loops: 9
Path:
Serres
Provatas
Ano_Kamila
Koumaria
Kato_Kamila
Skoutari
Peponia
Adelfiko
```

### 04: Serres -> Adelfiko (at least through 2 of Koumaria, Skoutari, Peponia, Provatas and then add also A. Kamila and K. Mitrousi)

**Serres -> Provatas -> A. Kamila -> Koumaria**

```
km: 26.669
Loops: 5
Path: 
Serres
Provatas
Ano_Kamila
Koumaria
```

**Koumaria -> (Peponia, Provatas, A. Kamila, K. Mitrousi) -> Adelfiko**

```
km: 31.063
Loops: 8
Path: 
Koumaria
Ano_Kamila
Kato_Mitrousi
Kato_Kamila
Skoutari
Peponia
Adelfiko
```

Total:
```
26.669 + 31.063 = 57.732
```

### 05: Serres -> Adelfiko (each bin weighs 100kg, 2 lorries, 400kg/lorry, only once to Adelfiko)

After experiments for the minimum route for the 1st lorry we choose to get the bins from:
 
```Provatas, Ano_Kamila, Kato_Mitrousi, Kato_Kamila```.


#### 1st Lorry

```
Serres-Provatas: 15.126
Provatas-Ano_Kamila: 5.144
Ano_Kamila-Kato_Mitrousi: 3.064
Kato_Mitrousi-Kato_Kamila: 7.04
Kato_Kamila-Koumaria: 5.735
Koumaria-Adelfiko: 2.466
Total km: 38.575
```

#### 2nd Lorry

```
Serres-Skoutari: 9.14
Skoutari-Agia_Eleni: 4.622
Agia_Eleni-Peponia: 4.734
Peponia-Adelfiko: 6.821
Adelfiko-Koumaria: 2.466
Koumaria-Adelfiko: 2.466
Total km: 30.249
```

Total km 1st & 2nd lorry: **68.824**


### 06: Serres -> Adelfiko (each bin weighs X, 2 lorries, 500kg/lorry1, 300kg/lorry2, only once to Adelfiko)

Same as on 05 (**68.824km**).

Notice that we choose not to get the bin from _Koumaria_ so the 2nd Lorry has to pick it and Lorry
 1 has 50kg less to carry.


#### 1st Lorry (300kg)

```
Serres-Provatas: 15.126 (60kg)
Provatas-Ano_Kamila: 5.144 (40kg)
Ano_Kamila-Kato_Mitrousi: 3.064 (160kg)
Kato_Mitrousi-Kato_Kamila: 7.04 (40kg)
Kato_Kamila-Koumaria: 5.735 (0kg - we do not collect it)
Koumaria-Adelfiko: 2.466 (0kg)
Total km: 38.575

Total Kg: 300
```


#### 2nd Lorry (500kg)

```
Serres-Skoutari: 9.14 (200kg)
Skoutari-Agia_Eleni: 4.622 (100kg)
Agia_Eleni-Peponia: 4.734 (150kg)
Peponia-Adelfiko: 6.821 (0kg)
Adelfiko-Koumaria: 2.466 (50kg)
Koumaria-Adelfiko: 2.466 (0kg)
Total km: 30.249

Total Kg: 500
```