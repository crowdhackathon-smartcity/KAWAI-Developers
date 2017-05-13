#include <LiquidCrystal.h>

LiquidCrystal lcd(12, 11, 5, 4, 3, 2);

int count = 0;
int row = 0;
int state = 1;

String wordOut = "";

void setup(){
  //Begins the serial connection
  Serial.begin(9600);
  lcd.begin(16,2);
  pinMode(LED_BUILTIN, OUTPUT);
  
}

void loop(){
  
 while(state){  

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("ENTER CODE:");
  delay(2000);
  if(Serial.available()){
    while(Serial.available()){
       delay(100);
       lcd.setCursor(0,1);
       
       row = 1;  
        
        
        char yep = Serial.read();

        wordOut = wordOut + yep;
        lcd.setCursor(0,row);
        lcd.print(wordOut);
        Serial.flush();
    }
     delay(2000);
     state = 0;
  }
  Serial.flush();
 
  
 }
 lcd.clear();
 lcd.setCursor(0, 0);
 lcd.print("WAITING...");
 delay(5000);

 if(Serial.available()){
    delay(100);
    int answer = Serial.parseInt();  
    lcd.setCursor(0, 0);
    lcd.clear();
    lcd.print(answer);
    if(answer > 0) {
      lcd.print("OK");
      digitalWrite(LED_BUILTIN, HIGH);   
      delay(5000);
      digitalWrite(LED_BUILTIN, LOW); 
      Serial.flush();
      wordOut = "";
      state = 1;
    } else {
      lcd.print("FALSE CODE"); 
      delay(5000);
      Serial.flush();
      wordOut = "";
      state = 1;
    }
    Serial.flush();
 
  
  
  }
}

