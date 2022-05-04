--- OBS Api.
-- Note that this isn't the official OBS API, I just haven't figured out a name for this project yet

-- first line is ignored I guess???
local _ = nil

--- Repeat function every so often.
function update()
end

--- bin bak.
-- @param color (table) color to use: {r, g, b, a}; r,g,b,a integers < 256 (a defaults to 255)
-- @param x (int) x of the element
-- @param y (int) y of the element
-- @param width (int) width of the element in pixels
-- @param height (int) height of the element in pixels
-- @return (ColorElement)
function ColorElement.new(color,x,y,width,height)
    return ColorElement
end

--- bin bak.
-- @param text (string) initial text to use
-- @param x (int) x of the element
-- @param y (int) y of the element
-- @param width (int) width of the element in pixels
-- @param height (int) height of the element in pixels
-- @param fontsize (int) font size of the text
-- @return (TextElement)
function TextElement.new(text,x,y,width,height,fontsize)
    return TextElement
end