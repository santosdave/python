menu = [
        "Start new game",
        "Resume saved game",
        "Display help",
        "Quit"
    ]

import game_logic

def getMenuChoice(user_menu):
    if not user_menu:
        raise ValueError("No user menu available")
    while True:
        print('\n\n')
        for index, item in enumerate(user_menu, start=1):
            print(index, '\t', item)
        try:
            choice = int(input('\n Choose a menu option -> '))
            if 1 <= choice <= len(user_menu):
                return choice
            else:
                print('\n Choose a number between 1 and ',len(user_menu))
        except ValueError:
            print("Choose the number of a menu option displayed")


def startGame():
    game_logic.newGame()

def resumeGame():
    game_logic.restoreGame()

def displayHelp():
    print('''
    Start new game: starts a new game of tic‐tac‐toe
    Resume saved game: restores the last saved game and commences play
    Display help: shows this page
    Quit: quits the application
    ''')

def quitGame():
    print("Goodbye! ..")
    raise SystemExit

def executeChoice(choice):
    dispatch = [startGame, resumeGame, displayHelp, quitGame]
    game = dispatch[choice-1]()
    if choice == 1 or choice == 2:
        print(game)
def main():
    while True:
        choice= getMenuChoice(menu)
        executeChoice(choice)


if __name__ == "__main__":
    main()