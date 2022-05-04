--local myColor = ColorElement.new({155, 103, 60}, 50, 0, 100, 100)
--local myText = TextElement.new("foo bar", 50, 0, 100, 100, 24)
--local lor = LegendsOfRuneterra
--return lor.ActiveDeck.DeckCode
--local myColor = ColorElement.new({155, 103, 60}, 0, 0, 1920, 100)
local myText = TextElement.new(LegendsOfRuneterra.ActiveDeck.DeckCode or "<no active deck>", 0, 0, 1920, 100, 48)
function update()
    TextElement.new(LegendsOfRuneterra.ActiveDeck.DeckCode or "<no active deck>", 0, 0, 1920, 100, 48)
end
