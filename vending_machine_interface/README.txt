Vending Machine Interface

Hardware:
1. Arduino uno Rev. 3
2. 16x2 LCD Screen (compatible with Hitachi HD44780 driver)

Librarys:
LiquidCrystal Library(installed through arduino IDE)

Arduino IDE version used: 1.8.2

This interface works in 2 states (0, 1):
1. State 0: Waits for the person in need pin number
2. State 1: Waits for client response

State transition:
 0->1 Pin is entered
 1->0 Response is handled (if positive relay activated)

Resources:
https://www.arduino.cc/en/Tutorial/HelloWorld
https://github.com/joshmeek/Python-Arduino-LCD
