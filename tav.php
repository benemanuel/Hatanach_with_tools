<?php
//gets letter and returns
//1 type [0-undefined,1-Letters,2-Final Letters, 3-Nikud, 4-SublinerTaamim,5-SuperlinierTaamim, 6-OtherTammim, 7-Glifs, 8-EOW/EOV, 9-Mesora/Footnote]
//Taamim: echo -e $(printf '\\U%x' $(seq 0x590 0x5ae))
//Nikud:  echo -e $(printf '\\U%x' $(seq 0x5b0 0x5c3))
//Letters:  echo -e $(printf '\\U%x' $(seq 0x5d0 0x5ea))
//Glifs: echo -e $(printf '\\U%x' $(seq 0x5f0 0x5f2))

//2 location in word [first,any middle,last]
//3 value
//4 glif
include"utf8toUnicode.php";

function tav($letter,$location){
switch(utf8toUnicode($letter)){
case "\u0590": return [0,$location,"\u0590","\u0590"]; break; 
case "\u0591": return [4,$location,"\u0591","\u0591","ACCENT","ETNAHTA"]; break;  
case "\u0592": return [5,$location,"\u0592","\u0592","ACCENT","SEGOL"]; break;  
case "\u0593": return [5,$location,"\u0593","\u0593","ACCENT","SHALSHELET"]; break;  
case "\u0594": return [5,$location,"\u0594","\u0594","ACCENT","ZAQEF QATAN"]; break;  
case "\u0595": return [5,$location,"\u0595","\u0595","ACCENT","ZAQEF GADOL"]; break;  
case "\u0596": return [4,$location,"\u0596","\u0596","ACCENT","TIPEHA"]; break;  
case "\u0597": return [5,$location,"\u0597","\u0597","ACCENT","REVIA"]; break;  
case "\u0598": return [5,$location,"\u0598","\u0598","ACCENT","ZARQA"]; break;  
case "\u0599": return [5,$location,"\u0599","\u0599","ACCENT","PASHTA"]; break;  
case "\u059a": return [4,$location,"\u059a","\u059a","ACCENT","YETIV"]; break;  
case "\u059b": return [4,$location,"\u059b","\u059b","ACCENT","TEVIR"]; break;  
case "\u059c": return [5,$location,"\u059c","\u059c","ACCENT","GERESH"]; break;  
case "\u059d": return [5,$location,"\u059d","\u059d","ACCENT","GERESH MUQDAM"]; break;  
case "\u059e": return [5,$location,"\u059e","\u059e","ACCENT","GERSHAYIM"]; break;  
case "\u059f": return [5,$location,"\u059f","\u059f","ACCENT","QARNEY PARA"]; break;  
case "\u05a0": return [5,$location,"\u05a0","\u05a0","ACCENT","TELISHA GEDOLA"]; break;  
case "\u05a1": return [5,$location,"\u05a1","\u05a1","ACCENT","PAZER"]; break;  
case "\u05a2": return [4,$location,"\u05a2","\u05a2","ACCENT","ATNAH HAFUKH"]; break;  
case "\u05a3": return [4,$location,"\u05a3","\u05a3","ACCENT","MUNAH"]; break;  
case "\u05a4": return [4,$location,"\u05a4","\u05a4","ACCENT","MAHAPAKH"]; break;  
case "\u05a5": return [4,$location,"\u05a5","\u05a5","ACCENT","MERKHA"]; break;  
case "\u05a6": return [4,$location,"\u05a6","\u05a6","ACCENT","MERKHA KEFULA"]; break;  
case "\u05a7": return [4,$location,"\u05a7","\u05a7","ACCENT","DARGA"]; break;  
case "\u05a8": return [5,$location,"\u05a8","\u05a8","ACCENT","QADMA"]; break;  
case "\u05a9": return [5,$location,"\u05a9","\u05a9","ACCENT","TELISHA QETANA"]; break;  
case "\u05aa": return [4,$location,"\u05aa","\u05aa","ACCENT","YERAH BEN YOMO"]; break;  
case "\u05ab": return [5,$location,"\u05ab","\u05ab","ACCENT","OLE"]; break;  
case "\u05ac": return [5,$location,"\u05ac","\u05ac","ACCENT","ILUY"]; break;  
case "\u05ad": return [4,$location,"\u05ad","\u05ad","ACCENT","DEHI"]; break;  
case "\u05ae": return [5,$location,"\u05ae","\u05ae","ACCENT","ZINOR"]; break;  
case "\u05af": return [9,$location,"\u05af","\u05af","MARK","MASORA CIRCLE"]; break;  
case "\u05b0": return [3,$location,"\u05b0","\u05b0","POINT","SHEVA"]; break;  
case "\u05b1": return [3,$location,"\u05b1","\u05b1","POINT","HATAF SEGOL"]; break;  
case "\u05b2": return [3,$location,"\u05b2","\u05b2","POINT","HATAF PATAH"]; break;  
case "\u05b3": return [3,$location,"\u05b3","\u05b3","POINT","HATAF QAMATS"]; break;  
case "\u05b4": return [3,$location,"\u05b4","\u05b4","POINT","HIRIQ"]; break;  
case "\u05b5": return [3,$location,"\u05b5","\u05b5","POINT","TSERE"]; break;  
case "\u05b6": return [3,$location,"\u05b6","\u05b6","POINT","SEGOL"]; break;  
case "\u05b7": return [3,$location,"\u05b7","\u05b7","POINT","PATAH"]; break;  
case "\u05b8": return [3,$location,"\u05b8","\u05b8","POINT","QAMATS"]; break;  
case "\u05b9": return [3,$location,"\u05b9","\u05b9","POINT","HOLAM"]; break;  
case "\u05ba": return [3,$location,"\u05ba","\u05ba","POINT","HOLAM HASER FOR VAV"]; break;  
case "\u05bb": return [3,$location,"\u05bb","\u05bb","POINT","QUBUTS"]; break;  
case "\u05bc": return [3,$location,"\u05bc","\u05bc","POINT","DAGESH OR MAPIQ"]; break;  
case "\u05bd": return [4,$location,"\u05bd","\u05bd","POINT","METEG"]; break;  
case "\u05be": return [6,$location,"\u05be","\u05be","PUNCTUATION","MAQAF"]; break;  
case "\u05bf": return [6,$location,"\u05bf","\u05bf","POINT","RAFE"]; break;  
case "\u05c0": return [8,$location,"\u05c0","\u05c0","PUNCTUATION","PASEQ"]; break;  
case "\u05c1": return [3,$location,"\u05c1","\u05c1","POINT","SHIN DOT"]; break;  
case "\u05c2": return [3,$location,"\u05c2","\u05c2","POINT","SIN DOT"]; break;  
case "\u05c3": return [8,$location,"\u05c3","\u05c3","PUNCTUATION","SOF PASUQ"]; break;  
case "\u05c4": return [5,$location,"\u05c4","\u05c4","MARK","UPPER DOT"]; break;  
case "\u05c5": return [4,$location,"\u05c5","\u05c5","MARK","LOWER DOT"]; break;  
case "\u05c6": return [8,$location,"\u05c6","\u05c6","PUNCTUATION","NUN HAFUKHA"]; break;  
case "\u05c7": return [3,$location,"\u05c7","\u05c7","POINT","QAMATS QATAN"]; break;  
case "\u05c8": return [0,$location,"\u05c8","\u05c8"]; break; 
case "\u05c9": return [0,$location,"\u05c9","\u05c9"]; break; 
case "\u05ca": return [0,$location,"\u05ca","\u05ca"]; break; 
case "\u05cb": return [0,$location,"\u05cb","\u05cb"]; break; 
case "\u05cc": return [0,$location,"\u05cc","\u05cc"]; break; 
case "\u05cd": return [0,$location,"\u05cd","\u05cd"]; break; 
case "\u05ce": return [0,$location,"\u05ce","\u05ce"]; break; 
case "\u05cf": return [0,$location,"\u05cf","\u05cf"]; break; 
case "\u05d0": return [1,$location,"\u05d0","\u05d0","LETTER","ALEF"]; break;  
case "\u05d1": return [1,$location,"\u05d1","\u05d1","LETTER","BET"]; break;  
case "\u05d2": return [1,$location,"\u05d2","\u05d2","LETTER","GIMEL"]; break;  
case "\u05d3": return [1,$location,"\u05d3","\u05d3","LETTER","DALET"]; break;  
case "\u05d4": return [1,$location,"\u05d4","\u05d4","LETTER","HE"]; break;  
case "\u05d5": return [1,$location,"\u05d5","\u05d5","LETTER","VAV"]; break;  
case "\u05d6": return [1,$location,"\u05d6","\u05d6","LETTER","ZAYIN"]; break;  
case "\u05d7": return [1,$location,"\u05d7","\u05d7","LETTER","HET"]; break;  
case "\u05d8": return [1,$location,"\u05d8","\u05d8","LETTER","TET"]; break;  
case "\u05d9": return [1,$location,"\u05d9","\u05d9","LETTER","YOD"]; break;  
case "\u05da": return [2,$location,"\u05da","\u05da","LETTER","FINAL KAF"]; break;  
case "\u05db": return [1,$location,"\u05db","\u05db","LETTER","KAF"]; break;  
case "\u05dc": return [1,$location,"\u05dc","\u05dc","LETTER","LAMED"]; break;  
case "\u05dd": return [2,$location,"\u05dd","\u05dd","LETTER","FINAL MEM"]; break;  
case "\u05de": return [1,$location,"\u05de","\u05de","LETTER","MEM"]; break;  
case "\u05df": return [2,$location,"\u05df","\u05df","LETTER","FINAL NUN"]; break;  
case "\u05e0": return [1,$location,"\u05e0","\u05e0","LETTER","NUN"]; break;  
case "\u05e1": return [1,$location,"\u05e1","\u05e1","LETTER","SAMEKH"]; break;  
case "\u05e2": return [1,$location,"\u05e2","\u05e2","LETTER","AYIN"]; break;  
case "\u05e3": return [2,$location,"\u05e3","\u05e3","LETTER","FINAL PE"]; break;  
case "\u05e4": return [1,$location,"\u05e4","\u05e4","LETTER","PE"]; break;  
case "\u05e5": return [2,$location,"\u05e5","\u05e5","LETTER","FINAL TSADI"]; break;  
case "\u05e6": return [1,$location,"\u05e6","\u05e6","LETTER","TSADI"]; break;  
case "\u05e7": return [1,$location,"\u05e7","\u05e7","LETTER","QOF"]; break;  
case "\u05e8": return [1,$location,"\u05e8","\u05e8","LETTER","RESH"]; break;  
case "\u05e9": return [1,$location,"\u05e9","\u05e9","LETTER","SHIN"]; break;  
case "\u05ea": return [1,$location,"\u05ea","\u05ea","LETTER","TAV"]; break;  
case "\u05eb": return [0,$location,"\u05eb","\u05eb"]; break; 
case "\u05ec": return [0,$location,"\u05ec","\u05ec"]; break; 
case "\u05ed": return [0,$location,"\u05ed","\u05ed"]; break; 
case "\u05ee": return [0,$location,"\u05ee","\u05ee"]; break; 
case "\u05ef": return [7,$location,"\u05ef","\u05ef","LIGATURE","YOD TRIANGLE"]; break;  
case "\u05f0": return [8,$location,"\u05f0","\u05f0","LIGATURE","YIDDISH DOUBLE VAV"]; break;  
case "\u05f1": return [8,$location,"\u05f1","\u05f1","LIGATURE","YIDDISH VAV YOD"]; break;  
case "\u05f2": return [8,$location,"\u05f2","\u05f2","LIGATURE","YIDDISH DOUBLE YOD"]; break;  
case "\u05f3": return [7,$location,"\u05f3","\u05f3","PUNCTUATION","GERESH"]; break;  
case "\u05f4": return [7,$location,"\u05f4","\u05f4","PUNCTUATION","GERSHAYIM"]; break;  
case "\u05f5": return [0,$location,"\u05f5","\u05f5"]; break; 
case "\u05f6": return [0,$location,"\u05f6","\u05f6"]; break; 
case "\u05f7": return [0,$location,"\u05f7","\u05f7"]; break; 
case "\u05f8": return [0,$location,"\u05f8","\u05f8"]; break; 
case "\u05f9": return [0,$location,"\u05f9","\u05f9"]; break; 
case "\u05fa": return [0,$location,"\u05fa","\u05fa"]; break; 
case "\u05fb": return [0,$location,"\u05fb","\u05fb"]; break; 
case "\u05fc": return [0,$location,"\u05fc","\u05fc"]; break; 
case "\u05fd": return [0,$location,"\u05fd","\u05fd"]; break; 
case "\u05fe": return [0,$location,"\u05fe","\u05fe"]; break; 
case "\u05ff": return [0,$location,"\u05ff","\u05ff"]; break; 
default: switch(ord($letter)){
    case 32: return [8,$location,"","","PUNCTUATION","SPACE"]; break;
    default:
          //echo "other:".PHP_EOL;
        return [0,$location,$letter,ord($letter),"Ascii","Charactor"];
          //echo PHP_EOL;
       }
}
return [10,0,0,$letter,ord($letter),"Ascii",$letter];
}
