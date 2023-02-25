


''' This is the main logic for a tic‐tac‐toe game.
It is not optimised for a quality game it simply
generates random moves and checks the results of
a move for a winning line. Exposed functions are:
newGame()
saveGame()
restoreGame()
userMove()
computerMove()
'''


import os, random
import game_data

def newGame():
 return list("2 " * 9)

def saveGame(game):
    game_data.saveGame(game)


def restoreGame():
    try:
        game= game_data.restoreGame()
        if len(game) == 9:
            return game
        else:
            return newGame()
    except IOError:
        return newGame()

